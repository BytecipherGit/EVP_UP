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
        Schema::create('emp_workhistories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id')->comment('emp_basicinfo Table PK');
            $table->foreign('emp_id')->references('id')->on('emp_basicinfo')->onDelete('cascade');
            $table->string('com_name')->nullable();
            $table->string('work_duration_from')->nullable();
            $table->string('work_duration_to')->nullable();
            $table->string('designation')->nullable();
            $table->string('offer_letter')->nullable();
            $table->string('exp_letter')->nullable();
            $table->string('salary_slip')->nullable();
            $table->string('verification_type')->nullable();
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
        Schema::table('emp_workhistories', function (Blueprint $table) {
            $table->dropForeign('emp_workhistories_emp_id_foreign');
            $table->dropColumn('emp_id');
        });
        Schema::dropIfExists('emp_workhistories');
    }
};
