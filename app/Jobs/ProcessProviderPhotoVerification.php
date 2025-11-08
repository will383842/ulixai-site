<?php

namespace App\Jobs;

use App\Models\User;
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
    public $timeout = 30;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var array
     */
    public $backoff = [5, 10, 20];

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The image path.
     *
     * @var string
     */
    protected $imagePath;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $imagePath)
    {
        $this->user = $user;
        $this->imagePath = $imagePath;
    }

    /**
     * Execute the job.
     */
    public function handle(ProviderPhotoVerificationService $service): void
    {
        Log::channel('google-vision')->info('Processing photo verification job', [
            'user_id' => $this->user->id,
            'attempt' => $this->attempts()
        ]);

        // Verify the profile photo
        $service->verifyProfilePhoto($this->user, $this->imagePath);
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        Log::channel('google-vision')->error('Photo verification job failed after all retries', [
            'user_id' => $this->user->id,
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);

        // Update user with error
        $this->user->update([
            'profile_photo_verified' => false,
            'profile_photo_rejection_reason' => "⚠️ Verification failed after multiple attempts. Please try again later or contact support."
        ]);
    }
}