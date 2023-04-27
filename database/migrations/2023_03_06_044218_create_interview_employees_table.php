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
            $table->unsignedBigInteger('employee_id')->comment('employee Table PK');
            $table->foreign('employee_id')->references('id')->on('employee')->comment('Id form employee')->onDelete('cascade');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('employee_offer_id')->nullable()->comment('employee_offer_statuses Table id');
            $table->string('position')->nullable();
            $table->string('rating')->nullable();
            $table->string('resume')->nullable();
            $table->string('instruction')->nullable();
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
