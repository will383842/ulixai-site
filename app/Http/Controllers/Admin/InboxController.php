<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminMessageStatus;
use App\Models\PressInquiry;
use App\Models\BugReport;
use App\Models\PartnershipRequest;
use App\Models\RecruitApplication;

class InboxController extends Controller
{
    // Vue principale
    public function index(Request $request)
    {
        return view('admin.messages.index');
    }

    // API JSON: liste unifiée avec filtres
    public function list(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'type' => 'nullable|in:all,press,reportbug,partner,recruitment',
            'status' => 'nullable|in:all,read,unread,processed,unprocessed',
            'search' => 'nullable|string|max:255',
            'sort' => 'nullable|in:created_at,name,email,status',
            'direction' => 'nullable|in:asc,desc',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:5|max:100',
        ])->validate();

        $type = $validated['type'] ?? 'all';
        $status = $validated['status'] ?? 'all';
        $search = $validated['search'] ?? null;
        $sort = $validated['sort'] ?? 'created_at';
        $direction = $validated['direction'] ?? 'desc';
        $page = (int)($validated['page'] ?? 1);
        $perPage = (int)($validated['per_page'] ?? 20);

        // Build datasets
        $datasets = [];

        if ($type === 'all' || $type === 'press') {
            $q = PressInquiry::query()
                ->select([
                    'press_inquiries.id as id',
                    DB::raw("'press' as type"),
                    'press_inquiries.media_name as name',
                    'press_inquiries.email as email',
                    'press_inquiries.message as message',
                    'press_inquiries.status as native_status',
                    'press_inquiries.created_at as created_at'
                ]);
            if ($search) {
                $q->where(function($qq) use ($search){
                    $qq->where('press_inquiries.media_name','like',"%{$search}%")
                       ->orWhere('press_inquiries.email','like',"%{$search}%")
                       ->orWhere('press_inquiries.message','like',"%{$search}%");
                });
            }
            $datasets[] = $q;
        }

        if ($type === 'all' || $type === 'reportbug') {
            $q = BugReport::query()
                ->select([
                    'bug_reports.id as id',
                    DB::raw("'reportbug' as type"),
                    DB::raw("COALESCE(NULLIF(bug_reports.country,''),'—') as name"),
                    DB::raw("'' as email"),
                    'bug_reports.bug_description as message',
                    DB::raw("'new' as native_status"),
                    'bug_reports.created_at as created_at'
                ]);
            if ($search) {
                $q->where(function($qq) use ($search){
                    $qq->where('bug_reports.bug_description','like',"%{$search}%")
                       ->orWhere('bug_reports.suggestions','like',"%{$search}%");
                });
            }
            $datasets[] = $q;
        }

        if ($type === 'all' || $type === 'partner') {
            $q = PartnershipRequest::query()
                ->select([
                    'partnership_requests.id as id',
                    DB::raw("'partner' as type"),
                    DB::raw("CONCAT(COALESCE(partnership_requests.first_name,''),' ',COALESCE(partnership_requests.last_name,'')) as name"),
                    DB::raw("NULL as email"),
                    'partnership_requests.motivation as message',
                    DB::raw("COALESCE(partnership_requests.status,'new') as native_status"),
                    'partnership_requests.created_at as created_at'
                ]);
            if ($search) {
                $q->where(function($qq) use ($search){
                    $qq->where('partnership_requests.first_name','like',"%{$search}%")
                       ->orWhere('partnership_requests.last_name','like',"%{$search}%")
                       ->orWhere('partnership_requests.email','like',"%{$search}%")
                       ->orWhere('partnership_requests.motivation','like',"%{$search}%");
                });
            }
            $datasets[] = $q;
        }

        if ($type === 'all' || $type === 'recruitment') {
            $q = RecruitApplication::query()
                ->select([
                    'recruit_applications.id as id',
                    DB::raw("'recruitment' as type"),
                    DB::raw("CONCAT(COALESCE(recruit_applications.first_name,''),' ',COALESCE(recruit_applications.last_name,'')) as name"),
                    'recruit_applications.email as email',
                    'recruit_applications.message as message',
                    'recruit_applications.status as native_status',
                    'recruit_applications.created_at as created_at'
                ]);
            if ($search) {
                $q->where(function($qq) use ($search){
                    $qq->where('recruit_applications.first_name','like',"%{$search}%")
                       ->orWhere('recruit_applications.last_name','like',"%{$search}%")
                       ->orWhere('recruit_applications.email','like',"%{$search}%")
                       ->orWhere('recruit_applications.message','like',"%{$search}%");
                });
            }
            $datasets[] = $q;
        }

        // Union all queries
        if (empty($datasets)) {
            return response()->json(['data'=>[], 'pagination'=>['total'=>0,'page'=>$page,'per_page'=>$perPage]]);
        }

        $union = null;
        foreach ($datasets as $q) {
            if ($union === null) {
                $union = $q;
            } else {
                $union = $union->unionAll($q);
            }
        }

        $wrapped = DB::query()->fromSub($union, 'items')
            ->leftJoin('admin_message_statuses as s', function($join){
                $join->on('s.message_id','=','items.id')->on('s.message_type','=','items.type');
            });

        // Status filters
        if ($status === 'read') $wrapped->where('s.is_read', true);
        if ($status === 'unread') $wrapped->where(function($q){
            $q->whereNull('s.is_read')->orWhere('s.is_read', false);
        });
        if ($status === 'processed') $wrapped->where('s.is_processed', true);
        if ($status === 'unprocessed') $wrapped->where(function($q){
            $q->whereNull('s.is_processed')->orWhere('s.is_processed', false);
        });

        // Sorting
        $allowed = ['created_at','name','email','native_status'];
        $sortCol = in_array($sort,$allowed) ? $sort : 'created_at';
        $wrapped->orderBy($sortCol, $direction);

        // Pagination
        $total = (clone $wrapped)->count();
        $items = $wrapped->forPage($page, $perPage)->get([
            'items.id','items.type','items.name','items.email','items.message','items.native_status','items.created_at',
            DB::raw('COALESCE(s.is_read,false) as is_read'),
            DB::raw('COALESCE(s.is_processed,false) as is_processed'),
            's.read_at','s.processed_at'
        ]);

        return response()->json([
            'data' => $items,
            'pagination' => [
                'total' => $total,
                'page' => $page,
                'per_page' => $perPage,
                'pages' => (int) ceil($total / max(1,$perPage)),
            ]
        ]);
    }

    // Marquer lu / traité
    public function markAsRead(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'type' => 'required|in:press,reportbug,partner,recruitment',
            'id' => 'required|integer|min:1',
            'is_read' => 'nullable|boolean',
            'is_processed' => 'nullable|boolean',
        ])->validate();

        $type = $validated['type'];
        $id = (int)$validated['id'];
        $isRead = array_key_exists('is_read',$validated) ? (bool)$validated['is_read'] : null;
        $isProcessed = array_key_exists('is_processed',$validated) ? (bool)$validated['is_processed'] : null;

        $status = AdminMessageStatus::firstOrNew(['message_type'=>$type,'message_id'=>$id]);
        if ($isRead !== null) {
            $status->is_read = $isRead;
            $status->read_at = $isRead ? now() : null;
        }
        if ($isProcessed !== null) {
            $status->is_processed = $isProcessed;
            $status->processed_at = $isProcessed ? now() : null;
        }
        $status->save();

        return response()->json(['ok'=>true]);
    }
}
