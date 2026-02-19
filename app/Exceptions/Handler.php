<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        // Erreurs Stripe → canal payments dédié (critique, conservé 90 jours)
        $this->reportable(function (ApiErrorException $e) {
            Log::channel('payments')->critical('Stripe API error', [
                'message'     => $e->getMessage(),
                'http_status' => $e->getHttpStatus(),
                'stripe_code' => $e->getStripeCode(),
                'request_id'  => $e->getRequestId(),
                'url'         => request()?->fullUrl(),
                'user_id'     => auth()?->id(),
            ]);
        });

        // Toutes les autres exceptions en production → laravel.log avec contexte HTTP
        $this->reportable(function (Throwable $e) {
            if ($e instanceof ApiErrorException) {
                return;
            }

            if (app()->environment('production')) {
                Log::error('Application exception', [
                    'exception' => get_class($e),
                    'message'   => $e->getMessage(),
                    'file'      => $e->getFile() . ':' . $e->getLine(),
                    'url'       => request()?->fullUrl(),
                    'method'    => request()?->method(),
                    'user_id'   => auth()?->id(),
                ]);
            }
        });
    }
}
