<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_appeals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('appeal_type', ['ban', 'strike', 'suspension'])->default('ban'); // Type d'appel
            $table->text('reason'); // Raison de l'appel
            $table->text('commitment')->nullable(); // Engagement à respecter les règles
            $table->text('evidence')->nullable(); // Preuves textuelles
            $table->enum('status', ['pending', 'approved', 'rejected', 'expired'])->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('admin_response')->nullable();
            $table->text('admin_notes')->nullable(); // Notes internes admin
            $table->integer('appeal_number')->default(1); // 1er, 2ème appel...
            $table->timestamp('submitted_at')->nullable(); // Date de soumission
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_appeals');
    }
};
