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
        Schema::create('interview_employees', function (Blueprint $table) {
            $table->id();
            $table->string('empCode')->nullable()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('designation')->nullable();
            $table->string('rating')->nullable();
            $table->enum('offer_status',['Pending','Accepted','Joined','Cancelled','Declined'])->comment('Pending / Accepted / Joined / Cancelled / Declined')->default('Pending');
            $table->unsignedBigInteger('interview_status')->comment('Hiring_stage Table PK');
            $table->foreign('interview_status')->references('id')->on('hiring_stages')->onDelete('cascade');
            $table->unsignedBigInteger('employee_interview_status')->comment('employee_interview_status table pk');
            $table->foreign('employee_interview_status')->references('id')->on('employee_interview_statuses')->onDelete('cascade');
            $table->date('interview_date')->default(Carbon::now()->format('Y-m-d'));
            $table->string('interview_start_time')->nullable();
            $table->string('interview_end_time')->nullable();
            $table->enum('interview_type',['Telephonic','Video'])->comment('Telephonic / Video')->default('Telephonic');
            $table->string('phone')->nullable();
            $table->string('video_link')->nullable();
            $table->string('message')->nullable();
            $table->string('attachment')->nullable();
            $table->longText('employee_comment')->nullable();
            $table->date('employee_comment_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interview_employees');
    }
};
