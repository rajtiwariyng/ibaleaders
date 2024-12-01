<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalProfileFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('years_in_business')->nullable();
            $table->text('previous_jobs')->nullable();
            $table->string('spouse')->nullable();
            $table->string('children')->nullable();
            $table->text('hobbies')->nullable();
            $table->text('skills')->nullable();
            $table->string('city_residence')->nullable();
            $table->string('years_in_city')->nullable();
            $table->text('burning_desire')->nullable();
            $table->text('key_success')->nullable();
            $table->text('gains_profile')->nullable();
            $table->text('ambitions')->nullable();
            $table->text('achievements')->nullable();
            $table->text('tops_profile')->nullable();
            $table->text('ideal_referrals')->nullable();
            $table->text('best_product')->nullable();
            $table->text('networking_groups')->nullable();
            $table->string('profile_image')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'years_in_business',
                'previous_jobs',
                'spouse',
                'children',
                'hobbies',
                'skills',
                'city_residence',
                'years_in_city',
                'burning_desire',
                'key_success',
                'gains_profile',
                'ambitions',
                'achievements',
                'tops_profile',
                'ideal_referrals',
                'best_product',
                'networking_groups',
            ]);
        });
    }
};
