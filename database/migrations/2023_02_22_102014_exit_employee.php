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
        Schema::create('exit_employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('employee_id');
            $table->string('date_of_exit');
            $table->string('decipline')->nullable();
            $table->string('reason_of_exit')->nullable();
            $table->string('rating')->nullable();
            $table->unsignedBigInteger('exit_process_id');
            $table->foreign('exit_process_id')->references('id')->on('employee_exit_processes')->onDelete('cascade');
            $table->tinyInteger('status')->default('0')->comment('1=Active, 0=Inactive');
            $table->string('document')->nullable();
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
        Schema::dropIfExists('exit_employee');
    }
};
