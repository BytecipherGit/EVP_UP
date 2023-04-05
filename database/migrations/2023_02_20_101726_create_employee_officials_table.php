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
            $table->integer('company_id');
            $table->string('doj')->nullable();
            $table->string('prob_period')->nullable();
            $table->string('emp_type')->nullable();
            $table->string('work_location')->nullable();
            $table->string('emp_status')->nullable();
            $table->string('salary')->nullable();
            $table->string('lpa')->nullable();
            $table->string('app_from')->nullable();
            $table->string('app_to')->nullable();
            $table->string('last_app_desig')->nullable();
            $table->string('current_app_desig')->nullable();
            $table->string('app_date')->nullable();
            $table->string('pro_from')->nullable();
            $table->string('pro_to')->nullable();
            $table->string('last_pro_desig')->nullable();
            $table->string('current_pro_desig')->nullable();
            $table->string('pro_date')->nullable();
            $table->string('mang_name')->nullable();
            $table->string('mang_type')->nullable();
            $table->string('mang_dept')->nullable();
            $table->string('mang_desig')->nullable();
    
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
        Schema::table('employee_officials', function (Blueprint $table) {
            $table->dropForeign('employee_officials_employee_id_foreign');
            $table->dropColumn('employee_id');
        });
        Schema::dropIfExists('employee_officials');
    }
};
