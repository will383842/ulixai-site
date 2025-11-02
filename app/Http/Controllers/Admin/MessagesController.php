<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        // Affiche la vue existante (ton Blade gère le design)
        return view('admin.messages.index');
    }

    public function list(Request $request)
    {
        $driver = config('messages.driver', 'internal');
        if ($driver === 'external') {
            return $this->listFromExternal($request);
        }
        return $this->listFromInternal($request);
    }

    public function toggle(Request $request)
    {
        $type = $request->input('type');
        $id = (int) $request->input('id');

        $meta = $this->pickSource($type);
        if (!$meta) {
            return response()->json(['ok' => true]);
        }
        $table = $meta['table'];

        if (!Schema::hasTable($table)) {
            return response()->json(['ok' => true]);
        }

        $columns = Schema::getColumnListing($table);
        $readFlag = $this->firstExisting($columns, $meta['read_flags'] ?? ['is_read','read','seen']);
        $procFlag = $this->firstExisting($columns, $meta['processed_flags'] ?? ['is_processed','processed','handled']);

        $update = [];
        if ($request->has('is_read') && $readFlag) {
            $update[$readFlag] = $request->boolean('is_read') ? 1 : 0;
        }
        if ($request->has('is_processed') && $procFlag) {
            $update[$procFlag] = $request->boolean('is_processed') ? 1 : 0;
        }

        if (!empty($update)) {
            DB::table($table)->where($meta['id'] ?? 'id', $id)->update($update);
        }

        return response()->json(['ok' => true]);
    }

    // ===================== INTERNAL ======================

    protected function listFromInternal(Request $request)
    {
        $type = $request->query('type', 'all');
        $status = $request->query('status', 'all');
        $search = trim((string)$request->query('search', ''));
        $sort = $request->query('sort', 'created_at');
        $direction = strtolower($request->query('direction', 'desc')) === 'asc' ? 'asc' : 'desc';
        $page = max(1, (int)$request->query('page', 1));
        $perPage = min(200, max(1, (int)$request->query('per_page', 20)));

        $types = $type === 'all' ? array_keys(config('messages.sources', [])) : [$type];

        $rows = [];
        foreach ($types as $t) {
            $meta = $this->pickSource($t);
            if (!$meta) continue;
            $table = $meta['table'];
            if (!Schema::hasTable($table)) continue;

            $cols = Schema::getColumnListing($table);

            // Auto-détection des colonnes
            $cId   = $meta['id'] ?? 'id';
            $cName = $this->firstExisting($cols, $meta['name_candidates'] ?? ['name','full_name','fullname','media','title','company']);
            $cEmail= $this->firstExisting($cols, $meta['email_candidates'] ?? ['email','email_address','contact_email']);
            $cMsg  = $this->firstExisting($cols, $meta['message_candidates'] ?? ['message','content','description','body','text']);
            $cStat = $this->firstExisting($cols, $meta['status_candidates'] ?? ['status','native_status','state']);
            $cCreated = $this->firstExisting($cols, $meta['created_at_candidates'] ?? ['created_at','createdOn','createdat','created_date','createdDate','date_created']);

            $readFlag = $this->firstExisting($cols, $meta['read_flags'] ?? ['is_read','read','seen']);
            $procFlag = $this->firstExisting($cols, $meta['processed_flags'] ?? ['is_processed','processed','handled']);

            $select = [$cId.' as _id'];
            if ($cCreated) $select[] = $cCreated.' as _created_at';
            if ($cName) $select[] = $cName.' as _name';
            if ($cEmail) $select[] = $cEmail.' as _email';
            if ($cMsg) $select[] = $cMsg.' as _message';
            if ($cStat) $select[] = $cStat.' as _native_status';
            if ($readFlag) $select[] = $readFlag.' as _is_read';
            if ($procFlag) $select[] = $procFlag.' as _is_processed';

            $q = DB::table($table)->selectRaw(implode(',', $select));

            // Filtre texte
            if ($search !== '') {
                $q->where(function($sub) use($cName,$cEmail,$cMsg,$search){
                    if ($cName) $sub->orWhere($cName, 'like', '%'.$search.'%');
                    if ($cEmail) $sub->orWhere($cEmail, 'like', '%'.$search.'%');
                    if ($cMsg) $sub->orWhere($cMsg, 'like', '%'.$search.'%');
                });
            }

            // On récupère sans pagination (fusion multi-sources), on pagine après
            $items = $q->get()->map(function($r) use($t){
                return [
                    'type' => $t,
                    'id' => $r->_id,
                    'name' => $r->_name ?? null,
                    'email' => $r->_email ?? null,
                    'message' => $r->_message ?? null,
                    'native_status' => $r->_native_status ?? null,
                    'is_read' => (int)($r->_is_read ?? 0),
                    'is_processed' => (int)($r->_is_processed ?? 0),
                    'created_at' => (string)($r->_created_at ?? ''),
                ];
            })->all();

            $rows = array_merge($rows, $items);
        }

        // Filtre status
        if ($status !== 'all') {
            $rows = array_values(array_filter($rows, function($r) use($status){
                if ($status === 'unread') return (int)$r['is_read'] === 0;
                if ($status === 'read') return (int)$r['is_read'] === 1;
                if ($status === 'unprocessed') return (int)$r['is_processed'] === 0;
                if ($status === 'processed') return (int)$r['is_processed'] === 1;
                return true;
            }));
        }

        // Tri
        $allowed = ['created_at','name','email','native_status'];
        if (!in_array($sort, $allowed, true)) $sort = 'created_at';
        usort($rows, function($a,$b) use($sort,$direction){
            $xa = $a[$sort] ?? null;
            $xb = $b[$sort] ?? null;
            if ($xa == $xb) return 0;
            if ($direction === 'asc') return ($xa <=> $xb);
            return ($xb <=> $xa);
        });

        // Pagination
        $total = count($rows);
        $pages = max(1, (int)ceil($total / $perPage));
        $page = min($page, $pages);
        $slice = array_slice($rows, ($page-1)*$perPage, $perPage);

        return response()->json([
            'data' => $slice,
            'pagination' => [
                'total' => $total,
                'page' => $page,
                'pages' => $pages,
            ],
        ]);
    }

    protected function listFromExternal(Request $request)
    {
        $baseUrl = rtrim(config('messages.external.url', ''), '/');
        if (!$baseUrl) {
            return response()->json(['data'=>[], 'pagination'=>['total'=>0,'page'=>1,'pages'=>1]]);
        }
        $token = config('messages.external.token', null);
        $params = $request->only(['type','status','search','sort','direction','page','per_page']);

        $http = Http::timeout(10);
        if ($token) $http = $http->withToken($token);

        try {
            $res = $http->get($baseUrl.'/messages', $params);
            if ($res->successful()) return response()->json($res->json());
        } catch (\Throwable $e) {}

        return response()->json(['data'=>[], 'pagination'=>['total'=>0,'page'=>1,'pages'=>1]]);
    }

    // ===================== Helpers ======================

    protected function firstExisting(array $columns, array $candidates)
    {
        foreach ($candidates as $c) {
            if (in_array($c, $columns, true)) return $c;
        }
        return null;
    }

    protected function pickSource(string $type): ?array
    {
        $cfg = config('messages.sources', []);
        if (!isset($cfg[$type])) return null;

        $entry = $cfg[$type];

        // Supporter plusieurs noms de tables candidats
        $tables = $entry['tables'] ?? null;
        if (is_array($tables)) {
            foreach ($tables as $t) {
                if (Schema::hasTable($t)) {
                    $entry['table'] = $t;
                    return $entry;
                }
            }
            // aucune table trouvée
            return null;
        }

        // Table unique
        if (isset($entry['table']) && Schema::hasTable($entry['table'])) {
            return $entry;
        }

        return null;
    }
}
