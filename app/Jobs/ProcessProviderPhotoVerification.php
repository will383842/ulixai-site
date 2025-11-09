<?php

namespace App\Jobs;

use App\Models\ProviderPhotoVerification;
use App\Services\ProviderPhotoVerificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessProviderPhotoVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;
    public $backoff = [5, 10, 20];

    protected $verification;

    public function __construct(ProviderPhotoVerification $verification)
    {
        $this->verification = $verification;
    }

    public function handle(ProviderPhotoVerificationService $service): void
    {
        Log::channel('google-vision')->info('Processing photo verification job', [
            'verification_id' => $this->verification->id,
            'attempt' => $this->attempts(),
            'image_path' => $this->verification->image_path
        ]);

        $service->verifyProfilePhoto($this->verification);

        Log::channel('google-vision')->info('Photo verification job completed', [
            'verification_id' => $this->verification->id,
            'status' => $this->verification->fresh()->status
        ]);
    }

    public function failed(Throwable $exception): void
    {
        Log::channel('google-vision')->error('Photo verification job failed after all retries', [
            'verification_id' => $this->verification->id,
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);

        $this->verification->update([
            'status' => 'error',
            'rejection_reason' => "⚠️ Verification failed after multiple attempts. Please try again later."
        ]);
    }
}