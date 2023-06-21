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
        Schema::create('employee_officials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->comment('employee Table PK');
            $table->foreign('employee_id')->references('id')->on('employee')->comment('Id form employee')->onDelete('cascade');
            $table->string('date_of_joining')->nullable();
            $table->string('emp_type')->nullable();
            $table->string('work_location')->nullable();
            $table->boolean('emp_status')->default(0)->comment('1 Active, 0 Inactive');
            // $table->enum('emp_status',['Active','Inactive'])->comment('Active / Inactive')->default('Inactive');
            $table->string('lpa')->nullable();
            $table->string('designation')->nullable();
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
        Schema::dropIfExists('employee_officials');
    }
};
