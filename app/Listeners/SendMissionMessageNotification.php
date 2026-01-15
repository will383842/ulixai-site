<?php

namespace App\Listeners;

use App\Events\MissionMessageSent;
use App\Models\Mission;
use App\Models\MissionMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMissionMessageNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The number of times the queued listener may be attempted.
     */
    public int $tries = 3;

    /**
     * Handle the event.
     */
    public function handle(MissionMessageSent $event): void
    {
        $mission = Mission::find($event->missionId);
        $message = MissionMessage::find($event->messageId);

        if (!$mission || !$message) {
            Log::warning('SendMissionMessageNotification: Mission or message not found', [
                'mission_id' => $event->missionId,
                'message_id' => $event->messageId,
            ]);
            return;
        }

        // Get the requester
        $requester = $mission->requester;

        if (!$requester || !$requester->email) {
            Log::warning('SendMissionMessageNotification: Requester not found or no email', [
                'mission_id' => $event->missionId,
                'requester_id' => $event->requesterId,
            ]);
            return;
        }

        // Don't notify if the requester is the sender
        if ($message->user_id === $requester->id) {
            return;
        }

        // Send email notification
        try {
            Mail::raw(
                "You have a new public message on your mission.\n\n" .
                "Mission: {$mission->title}\n" .
                "Message: " . substr($message->message, 0, 200) . (strlen($message->message) > 200 ? '...' : '') . "\n\n" .
                "View the mission: " . url('/missions/' . $mission->id),
                function ($mail) use ($requester) {
                    $mail->to($requester->email)
                         ->subject('New Message on Your Mission - Ulixai');
                }
            );

            Log::info('Mission message notification email sent', [
                'mission_id' => $event->missionId,
                'message_id' => $event->messageId,
                'recipient_email' => $requester->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send mission message notification email', [
                'mission_id' => $event->missionId,
                'message_id' => $event->messageId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(MissionMessageSent $event, \Throwable $exception): void
    {
        Log::error('SendMissionMessageNotification listener failed', [
            'mission_id' => $event->missionId,
            'message_id' => $event->messageId,
            'error' => $exception->getMessage(),
        ]);
    }
}
