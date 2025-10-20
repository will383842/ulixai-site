<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UlixCommission; 

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulix_commissions', function (Blueprint $table) {
            $table->id();

            $table->decimal('requester_fee', 5, 4)->default(0.0500);
            $table->decimal('provider_fee', 5, 4)->default(0.1500);
            $table->decimal('org_fee', 5, 4)->default(0.0500);
            $table->decimal('affiliate_fee', 5, 4)->default(0.0250);

            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default commission record
        \DB::table('ulix_commissions')->insert([
            'requester_fee' => 0.05,
            'provider_fee'  => 0.15,
            'org_fee'       => 0.05,
            'affiliate_fee' => 0.025,
            'description'   => 'Default commission structure',
            'is_active'     => true,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('ulix_commissions');
    }
};
