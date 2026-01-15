<?php

namespace App\Jobs;

use App\Models\ProviderDocumentVerification;
use App\Services\ProviderDocumentVerificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessProviderDocumentVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The queue this job should be sent to.
     *
     * @var string
     */
    public $queue = 'verification';

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 60;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var array
     */
    public $backoff = [5, 10, 20];

    /**
     * The document verification instance.
     *
     * @var \App\Models\ProviderDocumentVerification
     */
    protected $verification;

    /**
     * Create a new job instance.
     */
    public function __construct(ProviderDocumentVerification $verification)
    {
        $this->verification = $verification;
    }

    /**
     * Execute the job.
     */
    public function handle(ProviderDocumentVerificationService $service): void
    {
        Log::channel('google-vision')->info('Processing document verification job', [
            'verification_id' => $this->verification->id,
            'attempt' => $this->attempts()
        ]);

        // Verify the document
        $service->verifyDocument($this->verification);
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        Log::channel('google-vision')->error('Document verification job failed after all retries', [
            'verification_id' => $this->verification->id,
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);

        // Update verification status to error
        $this->verification->update([
            'verification_status' => 'error',
            'rejection_reason' => "⚠️ Verification failed after multiple attempts. Please try again later or contact support."
        ]);
    }
}