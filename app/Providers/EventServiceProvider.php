<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\MessageSent;
use App\Events\MissionMessageSent;
use App\Events\NotifyUser;
use App\Listeners\SendMessageNotification;
use App\Listeners\SendMissionMessageNotification;
use App\Listeners\LogUserNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MessageSent::class => [
            SendMessageNotification::class,
        ],
        MissionMessageSent::class => [
            SendMissionMessageNotification::class,
        ],
        NotifyUser::class => [
            LogUserNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
