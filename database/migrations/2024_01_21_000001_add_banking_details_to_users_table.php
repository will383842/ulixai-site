<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankingDetailsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bank_account_holder')->nullable();
            $table->string('bank_account_iban')->nullable();
            $table->string('bank_swift_bic')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_country')->nullable();
            $table->timestamp('bank_details_verified_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bank_account_holder',
                'bank_account_iban',
                'bank_swift_bic',
                'bank_name',
                'account_country',
                'bank_details_verified_at'
            ]);
        });
    }
}
