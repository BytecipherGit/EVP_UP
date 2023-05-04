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
            $table->unsignedInteger('employee_id')->comment('employee Table PK');
            $table->foreign('employee_id')->references('id')->on('employee')->comment('Id form employee')->onDelete('cascade');
            $table->string('date_of_joining')->nullable();
            $table->string('emp_type')->nullable();
            $table->string('work_location')->nullable();
            $table->boolean('emp_status')->default(0)->comment('1 Active, 0 Inactive');
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
        Schema::table('employee_officials', function (Blueprint $table) {
            $table->dropForeign('employee_officials_employee_id_foreign');
            $table->dropColumn('employee_id');
        });
        Schema::dropIfExists('employee_officials');
    }
};
