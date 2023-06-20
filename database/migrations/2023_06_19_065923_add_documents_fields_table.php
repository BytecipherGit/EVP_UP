<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->string('pan_card')->nullable();
            $table->string('pan_card_number')->nullable()->unique();
            $table->string('pan_card_id')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('aadhar_card_number')->nullable()->unique();
            $table->string('aadhar_card_id')->nullable();
            $table->string('passport')->nullable();
            $table->string('passport_number')->nullable()->unique();
            $table->string('passport_id')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee', function (Blueprint $table) {
            //
        });
    }
};
