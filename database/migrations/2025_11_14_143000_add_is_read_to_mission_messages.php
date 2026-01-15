<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Ajouter le champ is_read
        Schema::table('mission_messages', function (Blueprint $table) {
            $table->boolean('is_read')->default(false)->after('message');
            $table->index(['mission_id', 'is_read']); // Index pour optimiser les requêtes
        });

        // Marquer les messages de plus de 24h comme lus (évite l'explosion de badges)
        DB::table('mission_messages')
            ->where('created_at', '<', now()->subDay())
            ->update(['is_read' => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission_messages', function (Blueprint $table) {
            $table->dropIndex(['mission_id', 'is_read']);
            $table->dropColumn('is_read');
        });
    }
};
