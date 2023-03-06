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
            $table->string('designation')->nullable();
            $table->string('rating')->nullable();
            $table->enum('offer_status',['Pending','Accepted','Joined','Cancelled','Declined'])->comment('Pending / Accepted / Joined / Cancelled / Declined')->default('Pending');
            $table->tinyInteger('interview_status')->default('1');
            $table->date('interview_date')->default(Carbon::now()->format('Y-m-d'));
            $table->time('interview_start_time',$precision = 0);
            $table->time('interview_end_time',$precision = 0);
            $table->enum('interview_type',['Telephonic','Video'])->comment('Telephonic / Video')->default('Telephonic');
            $table->string('phone')->nullable();
            $table->string('video_link')->nullable();
            $table->string('message')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('interview_employees');
    }
};
