<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('industry')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('brand_logo')->nullable();
            $table->text('business_bio')->nullable();
            $table->text('keywords')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'industry',
                'mobile_number',
                'address',
                'city',
                'state',
                'pin_code',
                'brand_name',
                'brand_logo',
                'business_bio',
                'keywords',
            ]);
        });
    }
}
