<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Message;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\Category;

class MissionAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.missions');
    }

    public function apiList(Request $request)
    {
        $query = Mission::with(['requester', 'selectedProvider']);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $missions = $query->orderByDesc('created_at')->paginate(20);

        return response()->json([
            'missions' => $missions->items(),
            'pagination' => [
                'current_page' => $missions->currentPage(),
                'last_page' => $missions->lastPage(),
                'total' => $missions->total(),
            ]
        ]);
    }

    public function apiShow($id)
    {
        $mission = Mission::with(['requester', 'selectedProvider', 'transactions'])->findOrFail($id);
        return response()->json($mission);
    }

    public function show($id)
    {
        return view('admin.dashboard.mission-details', ['missionId' => $id]);
    }

    public function edit($id)
    {
        $mission = Mission::with(['requester', 'selectedProvider', 'category', 'subcategory'])->findOrFail($id);
        $categories = Category::where('level', 1)->with('subcategories.subSubCategories')->get();
        $providers = ServiceProvider::all();
        return view('admin.dashboard.mission-edit', compact('mission', 'categories', 'providers'));
    }

    public function update(Request $request, $id)
    {
        $mission = Mission::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:in_progress,completed,cancelled,published,waiting_to_start,disputed',
            'payment_status' => 'required|in:unpaid,paid,held,released,refunded',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'subsubcategory_id' => 'nullable|exists:categories,id',
            'selected_provider_id' => 'nullable|exists:service_providers,id',
        ]);

        $mission->fill($request->only([
            'title', 'description', 'status', 'payment_status', 'category_id', 'subcategory_id', 'subsubcategory_id', 'location_country', 'language', 'service_duration',
            'selected_provider_id'
        ]));

        if($request->service_duration === '1 week') {
            $mission->urgency = 'urgent';
        } 
        if($request->service_duration === '2 weeks') {
            $mission->urgency = 'medium';
        } 
        if($request->service_duration === '1 month') {
            $mission->urgency = 'low';
        } 

        $mission->save();

        return redirect()->route('admin.missions.show', $mission->id)->with('success', 'Mission updated successfully.');
    }

    public function conversation($id)
    {
        $mission = Mission::findOrFail($id);

        // Eager load conversation, messages, and sender (user)
        $conversation = $mission->conversation()
            ->with(['messages.sender'])
            ->first();

        return view('admin.dashboard.mission-conversation', compact('mission', 'conversation'));
    }

    public function destroy($id)
    {
        $mission = Mission::findOrFail($id);
        $attachments = json_decode($mission->attachments, true);
        if($attachments) {
            foreach($attachments as $attachment) {
                if(file_exists(public_path($attachment))) {
                    unlink(public_path($attachment));
                }
            }
        }

        $mission->delete();
        return response()->json([
            'success' => true,
            'message' => 'Mission deleted successfully.'
        ]);
    }

}
