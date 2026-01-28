<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Index de performance pour les requêtes fréquentes
     * Vérifie si l'index existe avant de le créer
     */
    public function up(): void
    {
        // Index sur missions
        $this->addIndexIfNotExists('missions', 'status', 'idx_missions_status');
        $this->addIndexIfNotExists('missions', 'payment_status', 'idx_missions_payment_status');
        $this->addIndexIfNotExists('missions', 'requester_id', 'idx_missions_requester_id');
        $this->addIndexIfNotExists('missions', 'selected_provider_id', 'idx_missions_selected_provider_id');
        $this->addIndexIfNotExists('missions', 'location_country', 'idx_missions_location_country');
        $this->addIndexIfNotExists('missions', 'created_at', 'idx_missions_created_at');
        $this->addCompositeIndexIfNotExists('missions', ['status', 'payment_status'], 'idx_missions_status_payment');

        // Index sur transactions
        $this->addIndexIfNotExists('transactions', 'status', 'idx_transactions_status');
        $this->addIndexIfNotExists('transactions', 'created_at', 'idx_transactions_created_at');
        $this->addIndexIfNotExists('transactions', 'stripe_payment_intent_id', 'idx_transactions_stripe_pi');

        // Index sur conversations
        $this->addIndexIfNotExists('conversations', 'requester_id', 'idx_conversations_requester_id');
        $this->addIndexIfNotExists('conversations', 'provider_id', 'idx_conversations_provider_id');
        $this->addIndexIfNotExists('conversations', 'last_message_at', 'idx_conversations_last_message');

        // Index sur messages
        $this->addIndexIfNotExists('messages', 'created_at', 'idx_messages_created_at');

        // Index sur mission_messages
        $this->addIndexIfNotExists('mission_messages', 'mission_id', 'idx_mission_messages_mission_id');
        $this->addIndexIfNotExists('mission_messages', 'user_id', 'idx_mission_messages_user_id');
    }

    /**
     * Ajoute un index simple si il n'existe pas
     */
    private function addIndexIfNotExists(string $table, string $column, string $indexName): void
    {
        if (!$this->indexExists($table, $indexName)) {
            DB::statement("ALTER TABLE `{$table}` ADD INDEX `{$indexName}` (`{$column}`)");
        }
    }

    /**
     * Ajoute un index composite si il n'existe pas
     */
    private function addCompositeIndexIfNotExists(string $table, array $columns, string $indexName): void
    {
        if (!$this->indexExists($table, $indexName)) {
            $columnsList = implode('`, `', $columns);
            DB::statement("ALTER TABLE `{$table}` ADD INDEX `{$indexName}` (`{$columnsList}`)");
        }
    }

    /**
     * Vérifie si un index existe
     */
    private function indexExists(string $table, string $indexName): bool
    {
        $result = DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name = ?", [$indexName]);
        return count($result) > 0;
    }

    /**
     * Rollback: Suppression des index (avec vérification)
     */
    public function down(): void
    {
        $this->dropIndexIfExists('missions', 'idx_missions_status');
        $this->dropIndexIfExists('missions', 'idx_missions_payment_status');
        $this->dropIndexIfExists('missions', 'idx_missions_requester_id');
        $this->dropIndexIfExists('missions', 'idx_missions_selected_provider_id');
        $this->dropIndexIfExists('missions', 'idx_missions_location_country');
        $this->dropIndexIfExists('missions', 'idx_missions_created_at');
        $this->dropIndexIfExists('missions', 'idx_missions_status_payment');

        $this->dropIndexIfExists('transactions', 'idx_transactions_status');
        $this->dropIndexIfExists('transactions', 'idx_transactions_created_at');
        $this->dropIndexIfExists('transactions', 'idx_transactions_stripe_pi');

        $this->dropIndexIfExists('conversations', 'idx_conversations_requester_id');
        $this->dropIndexIfExists('conversations', 'idx_conversations_provider_id');
        $this->dropIndexIfExists('conversations', 'idx_conversations_last_message');

        $this->dropIndexIfExists('messages', 'idx_messages_created_at');

        $this->dropIndexIfExists('mission_messages', 'idx_mission_messages_mission_id');
        $this->dropIndexIfExists('mission_messages', 'idx_mission_messages_user_id');
    }

    /**
     * Supprime un index si il existe
     */
    private function dropIndexIfExists(string $table, string $indexName): void
    {
        if ($this->indexExists($table, $indexName)) {
            DB::statement("ALTER TABLE `{$table}` DROP INDEX `{$indexName}`");
        }
    }
};
