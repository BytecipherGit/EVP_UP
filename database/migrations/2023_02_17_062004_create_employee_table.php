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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('empCode')->nullable()->unique();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('profile')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('dob')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('emg_name')->nullable();
            $table->string('emg_relationship')->nullable();
            $table->string('emg_phone')->nullable();
            $table->text('emg_address')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_number')->nullable()->unique();
            $table->string('document_id')->nullable();
            $table->tinyInteger('verification_type')->default('0')->comment('1=Verified, 0=Not Verified')->nullable();
            $table->string('third_party_document')->nullable();
            $table->tinyInteger('third_party_verification')->default('0')->comment('1=Verified, 0=Not Verified')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
};
