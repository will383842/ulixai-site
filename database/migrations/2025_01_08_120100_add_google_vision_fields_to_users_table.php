<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleVisionFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'profile_photo_status')) {
                $table->string('profile_photo_status')->default('pending');
            }
            if (!Schema::hasColumn('users', 'profile_photo_review_required')) {
                $table->boolean('profile_photo_review_required')->default(false);
            }
            if (!Schema::hasColumn('users', 'profile_photo_rejection_reason')) {
                $table->text('profile_photo_rejection_reason')->nullable();
            }
            if (!Schema::hasColumn('users', 'photo_verified_at')) {
                $table->timestamp('photo_verified_at')->nullable();
            }
            if (!Schema::hasColumn('users', 'google_vision_safe_search')) {
                $table->json('google_vision_safe_search')->nullable();
            }
            if (!Schema::hasColumn('users', 'google_vision_labels')) {
                $table->json('google_vision_labels')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'profile_photo_status',
                'profile_photo_review_required',
                'profile_photo_rejection_reason',
                'photo_verified_at',
                'google_vision_safe_search',
                'google_vision_labels',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
