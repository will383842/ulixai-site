<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ✅ SÉCURITÉ: Ajoute un index unique sur (mission_id, referrer_id, referee_id)
     * pour garantir qu'une seule commission par mission/parrain/filleul ne peut être créée.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliate_commissions', function (Blueprint $table) {
            // Index unique composite pour éviter les doublons de commissions
            $table->unique(
                ['mission_id', 'referrer_id', 'referee_id'],
                'affiliate_commissions_mission_referrer_referee_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliate_commissions', function (Blueprint $table) {
            $table->dropUnique('affiliate_commissions_mission_referrer_referee_unique');
        });
    }
};
