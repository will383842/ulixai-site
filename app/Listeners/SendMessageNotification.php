<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMessageNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The number of times the queued listener may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public array $backoff = [30, 60, 120];

    /**
     * The number of seconds the job can run before timing out.
     */
    public int $timeout = 30;

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        $message = $event->message;
        $conversation = $message->conversation;

        if (!$conversation) {
            Log::warning('SendMessageNotification: Conversation not found', [
                'message_id' => $message->id,
            ]);
            return;
        }

        // Determine the recipient (the user who is NOT the sender)
        $recipientId = $conversation->requester_id === $message->sender_id
            ? $conversation->provider_id
            : $conversation->requester_id;

        // Get recipient user
        $recipient = null;
        if ($recipientId === $conversation->requester_id) {
            $recipient = $conversation->requester;
        } else {
            $provider = $conversation->provider;
            $recipient = $provider?->user;
        }

        if (!$recipient || !$recipient->email) {
            Log::warning('SendMessageNotification: Recipient not found or no email', [
                'message_id' => $message->id,
                'recipient_id' => $recipientId,
            ]);
            return;
        }

        // Send email notification (if user has email notifications enabled)
        try {
            Mail::raw(
                "You have a new message in your conversation.\n\n" .
                "From: {$message->sender->name}\n" .
                "Message: " . substr($message->body, 0, 200) . (strlen($message->body) > 200 ? '...' : '') . "\n\n" .
                "View the conversation: " . url('/conversations/' . $conversation->id),
                function ($mail) use ($recipient) {
                    $mail->to($recipient->email)
                         ->subject('New Message - Ulixai');
                }
            );

            Log::info('Message notification email sent', [
                'message_id' => $message->id,
                'recipient_email' => $recipient->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send message notification email', [
                'message_id' => $message->id,
                'recipient_email' => $recipient->email,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(MessageSent $event, \Throwable $exception): void
    {
        Log::error('SendMessageNotification listener failed', [
            'message_id' => $event->message->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
