<?php

use Carbon\Carbon;
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
        Schema::create('interview_employee_rounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interview_employees_id');
            $table->foreign('interview_employees_id')->references('id')->on('interview_employees')->comment('Id from interview_employees table')->onDelete('cascade');
            $table->string('interviewer_id')->nullable()->comment('Comma seprated multiple interviewer_id');
            // $table->unsignedBigInteger('interviewer_id');
            // $table->foreign('interviewer_id')->references('id')->on('employee')->comment('as employee id from employee')->onDelete('cascade');
            $table->unsignedBigInteger('interview_processes_id');
            $table->foreign('interview_processes_id')->references('id')->on('interview_processes')->comment('Id from interview_processes')->onDelete('cascade');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('offer_status',['Pending','Accepted','Joined','Cancelled','Declined'])->comment('Pending / Accepted / Joined / Cancelled / Declined')->default('Pending');
            $table->unsignedBigInteger('interview_status')->comment('Hiring_stage Table PK');
            $table->foreign('interview_status')->references('id')->on('hiring_stages')->onDelete('cascade');
            $table->unsignedBigInteger('employee_interview_status')->comment('employee_interview_status table pk');
            $table->foreign('employee_interview_status')->references('id')->on('employee_interview_statuses')->onDelete('cascade');
            $table->boolean('isEmployeeResponseSubmitted')->default(false);
            $table->date('interview_date')->default(Carbon::now()->format('Y-m-d'));
            $table->string('interview_start_time')->nullable();
            $table->string('duration')->nullable();
            $table->enum('interview_type',['Telephonic','Video','At Office','At Home'])->comment('Telephonic / Video / At Office / At Home')->default('Telephonic');
            $table->string('phone')->nullable();
            $table->string('video_link')->nullable();
            $table->longText('interview_instructions')->nullable();
            $table->longText('interviewee_comment')->nullable();
            $table->date('interviewee_comment_date')->nullable();
            $table->longText('interview_feedback')->nullable();
            $table->enum('interviewer_status',['Qualified','Not Qualified','Not Appeared'])->comment('Qualified / Not Qualified / Not Appeared')->default('Not Qualified');
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
        Schema::dropIfExists('interview_employee_rounds');
    }
};
