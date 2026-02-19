<?php

namespace App\Listeners;

use App\Events\NotifyUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogUserNotification implements ShouldQueue
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
     *
     * This listener logs user notifications for analytics and debugging.
     * Additional notification logic (push notifications, SMS) can be added here.
     */
    public function handle(NotifyUser $event): void
    {
        // Log the notification for analytics
        Log::info('User notification event dispatched', [
            'event' => 'NotifyUser',
            'broadcast_channel' => 'notify-user-' . $event->user,
        ]);

        // Future: Add push notification logic here
        // Future: Add SMS notification logic here
        // Future: Store notification in database for notification center
    }

    /**
     * Handle a job failure.
     */
    public function failed(NotifyUser $event, \Throwable $exception): void
    {
        Log::error('LogUserNotification listener failed', [
            'error' => $exception->getMessage(),
        ]);
    }
}
