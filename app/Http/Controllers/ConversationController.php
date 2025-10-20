<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\ConversationReport;
use App\Models\Message;
use App\Models\Mission;
use App\Models\MessageAttachment;
use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use App\Events\MessageSent;
use App\Events\NotifyUser;



class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $providerId = optional($user->serviceProvider)->id;
        $missions = Mission::where('status', '!=', 'published')
            ->where('payment_status', '!=', 'released')
            ->whereNotNull('selected_provider_id')
            ->when($request->query('tab') === 'jobs', function ($q) use ($providerId, $user) {
                $q->where('selected_provider_id', $providerId)
                ->where('requester_id', '!=', $user->id);
            }, function ($q) use ($user, $providerId) {
                $q->where('requester_id', $user->id);
            })
            ->get();

        
        // Fetch all conversations for this user (as requester or provider)
        $conversations = Conversation::with('mission')
            ->where('requester_id', $user->id)
            ->orWhereHas('provider', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->latest('last_message_at')
            ->get();
        return view('dashboard.private-msg', compact('conversations', 'user', 'missions'));
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $conversations = Conversation::with('mission')
            ->where('requester_id', $user->id)
            ->orWhereHas('provider', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->latest('last_message_at')
            ->get();

        return response()->json($conversations);
    }

    public function show(Conversation $conversation)
    {
        $conversation->load(['mission', 'messages.sender']);
        return response()->json($conversation);
    }

    public function messages(Conversation $conversation)
    {
    
        $user = Auth::user();
        if ($conversation->mission->requester_id !== $user->id && 
            $conversation->mission->selectedProvider->user_id !== $user->id) {
            abort(403, 'Unauthorized access to conversation');
        }
        
        $messages = $conversation->messages()
            ->with(['sender', 'attachments'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        $conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        return response()->json($messages);
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        $request->validate([
            'body' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:20480', // 20MB max
        ]);

        $user = Auth::user();
        
        // Ensure at least message body or files are provided
        if (!$request->body && !$request->hasFile('files')) {
            return response()->json(['error' => 'Message body or files are required'], 422);
        }

        $messageData = [
            'sender_id' => $user->id,
            'body' => $request->body ?? '',
            'is_read' => false,
        ];

        $message = $conversation->messages()->create($messageData);

        $attachments = [];
        if ($request->hasFile('files')) {
            $conversationDir = 'public/conversations/conversation_' . $conversation->id;
            
            if (!Storage::exists($conversationDir)) {
                Storage::makeDirectory($conversationDir);
            }

            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . uniqid() . '.' . $extension;
                
                $filePath = $file->storeAs($conversationDir, $fileName);

                $attachment = $message->attachments()->create([
                    'filename' => $originalName,
                    'path' => str_replace('public/', '', $filePath), 
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ]);
                
                $attachments[] = $attachment;
            }
        }

        // Update conversation timestamp
        $conversation->last_message_at = now();
        $conversation->save();

        // Load relationships for broadcasting
        $message->load(['sender', 'attachments']);
        $message->attachments = $message->attachments ?? [];
        // Broadcast the message with attachments

        $otherUser = (auth()->user()->id === $conversation->provider->user_id ? $conversation->requester->id : $conversation->provider->user_id) ?? null;

        broadcast(new MessageSent($message))->toOthers();
        broadcast(new NotifyUser($conversation, $message, $otherUser, $message->sender->name, $conversation->mission->title))->toOthers();

        return response()->json([
            'message' => $message,
            'attachments' => $attachments
        ]);
    }


    public function start(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
        ]);
        $user = Auth::user();
        $mission = Mission::findOrFail($request->mission_id);
        $provider = ServiceProvider::findOrFail($mission->selected_provider_id);
        // Only requester or provider can start
        if ($user->id !== $mission->requester_id && $user->id !== $provider->user_id) {
            abort(403);
        }

        $conversation = Conversation::firstOrCreate([
            'mission_id' => $mission->id,
            'requester_id' => $mission->requester_id,
            'provider_id' => $provider->id,
        ]);

        return response()->json($conversation);
    }

    public function status(Conversation $conversation)
    {
        // Example: check if provider is online (using cache or last seen)
        $providerUserId = $conversation->provider->user_id;
        $isOnline = cache()->has('user-is-online-' . $providerUserId);
        return response()->json(['online' => $isOnline]);
    }


    public function downloadAttachment(MessageAttachment $attachment)
    {
        $user = Auth::user();
        $message = $attachment->message;
        $conversation = $message->conversation;
        
        if ($conversation->mission->requester_id !== $user->id && 
            $conversation->mission->selected_provider_id !== $user->id) {
            abort(403, 'Unauthorized access to attachment');
        }
        
        $filePath = storage_path('app/public/' . $attachment->path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        
        return response()->download($filePath, $attachment->filename);
    }


  public function report(Request $request, Conversation $conversation)
    {
        $request->validate([
            'reason' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Allow up to 3 reports per user per conversation
        $userReportCount = \App\Models\ConversationReport::where('conversation_id', $conversation->id)
            ->where('reported_by', $user->id)
            ->count();

        if ($userReportCount >= 3) {
            return response()->json(['message' => 'You have reached the maximum number of reports for this conversation.'], 409);
        }

        \App\Models\ConversationReport::create([
            'conversation_id' => $conversation->id,
            'reported_by' => $user->id,
            'reason' => $request->reason,
        ]);

        return response()->json(['message' => 'Conversation reported successfully.']);
    }

    public function isRead($id)
    {
        try {
            $user = Auth::user();

            $message = Message::findOrFail($id);

            $message->update(['is_read' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Message marked as read'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
