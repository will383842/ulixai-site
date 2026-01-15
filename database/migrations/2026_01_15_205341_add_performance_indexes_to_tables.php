<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Performance indexes for frequently queried columns.
     * Improves query performance for dashboard, listing, and filtering operations.
     */
    public function up()
    {
        // Missions table - Critical for dashboard and filtering
        Schema::table('missions', function (Blueprint $table) {
            $table->index('requester_id', 'idx_missions_requester_id');
            $table->index('status', 'idx_missions_status');
            $table->index('category_id', 'idx_missions_category_id');
            $table->index('selected_provider_id', 'idx_missions_selected_provider');
            $table->index('payment_status', 'idx_missions_payment_status');
            $table->index(['requester_id', 'status'], 'idx_missions_requester_status');
            $table->index(['status', 'payment_status'], 'idx_missions_status_payment');
        });

        // Service Providers - Critical for provider lookups
        Schema::table('service_providers', function (Blueprint $table) {
            $table->index('user_id', 'idx_providers_user_id');
            $table->index('provider_visibility', 'idx_providers_visibility');
        });

        // Transactions - Critical for financial reports
        Schema::table('transactions', function (Blueprint $table) {
            $table->index('mission_id', 'idx_transactions_mission_id');
            $table->index('provider_id', 'idx_transactions_provider_id');
            $table->index('offer_id', 'idx_transactions_offer_id');
            $table->index('status', 'idx_transactions_status');
            $table->index(['provider_id', 'status'], 'idx_transactions_provider_status');
            $table->index('created_at', 'idx_transactions_created_at');
        });

        // Conversations - Critical for messaging
        Schema::table('conversations', function (Blueprint $table) {
            $table->index('mission_id', 'idx_conversations_mission_id');
            $table->index('requester_id', 'idx_conversations_requester_id');
            $table->index('provider_id', 'idx_conversations_provider_id');
            $table->index('last_message_at', 'idx_conversations_last_message');
        });

        // Messages - Critical for chat retrieval
        Schema::table('messages', function (Blueprint $table) {
            $table->index('conversation_id', 'idx_messages_conversation_id');
            $table->index('sender_id', 'idx_messages_sender_id');
            $table->index('is_read', 'idx_messages_is_read');
            $table->index(['conversation_id', 'is_read'], 'idx_messages_conv_unread');
        });

        // Provider Reviews - Critical for ratings
        Schema::table('provider_reviews', function (Blueprint $table) {
            $table->index('provider_id', 'idx_reviews_provider_id');
            $table->index('user_id', 'idx_reviews_user_id');
            $table->index('mission_id', 'idx_reviews_mission_id');
            $table->index(['provider_id', 'rating'], 'idx_reviews_provider_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->dropIndex('idx_missions_requester_id');
            $table->dropIndex('idx_missions_status');
            $table->dropIndex('idx_missions_category_id');
            $table->dropIndex('idx_missions_selected_provider');
            $table->dropIndex('idx_missions_payment_status');
            $table->dropIndex('idx_missions_requester_status');
            $table->dropIndex('idx_missions_status_payment');
        });

        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropIndex('idx_providers_user_id');
            $table->dropIndex('idx_providers_visibility');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex('idx_transactions_mission_id');
            $table->dropIndex('idx_transactions_provider_id');
            $table->dropIndex('idx_transactions_offer_id');
            $table->dropIndex('idx_transactions_status');
            $table->dropIndex('idx_transactions_provider_status');
            $table->dropIndex('idx_transactions_created_at');
        });

        Schema::table('conversations', function (Blueprint $table) {
            $table->dropIndex('idx_conversations_mission_id');
            $table->dropIndex('idx_conversations_requester_id');
            $table->dropIndex('idx_conversations_provider_id');
            $table->dropIndex('idx_conversations_last_message');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex('idx_messages_conversation_id');
            $table->dropIndex('idx_messages_sender_id');
            $table->dropIndex('idx_messages_is_read');
            $table->dropIndex('idx_messages_conv_unread');
        });

        Schema::table('provider_reviews', function (Blueprint $table) {
            $table->dropIndex('idx_reviews_provider_id');
            $table->dropIndex('idx_reviews_user_id');
            $table->dropIndex('idx_reviews_mission_id');
            $table->dropIndex('idx_reviews_provider_rating');
        });
    }
};
