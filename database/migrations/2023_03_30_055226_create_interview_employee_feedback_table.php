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
        Schema::create('interview_employee_feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interview_employees_id');
            $table->foreign('interview_employees_id')->references('id')->on('interview_employees')->comment('Id from interview_employees table')->onDelete('cascade');
            $table->unsignedBigInteger('interview_round_id');
            $table->foreign('interview_round_id')->references('id')->on('interview_employee_rounds')->comment('Id from interview_employee_rounds table')->onDelete('cascade');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('feedback_id');
            $table->foreign('feedback_id')->references('id')->on('feedbacks')->onDelete('cascade');
            $table->string('feedback_rating')->default('0');
            $table->tinyInteger('status')->default('0')->comment('Status for feedback');
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
        Schema::dropIfExists('interview_employee_feedback');
    }
};
