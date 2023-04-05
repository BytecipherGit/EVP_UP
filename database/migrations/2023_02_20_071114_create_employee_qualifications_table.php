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
        Schema::create('employee_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->comment('employee Table PK');
            $table->foreign('employee_id')->references('id')->on('employee')->comment('Id form employee')->onDelete('cascade');
            $table->integer('company_id');
            $table->string('inst_name')->nullable();
            $table->string('degree')->nullable();
            $table->string('subject')->nullable();
            $table->string('duration_from')->nullable();
            $table->string('duration_to')->nullable();
            $table->string('document')->nullable();
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
        Schema::table('employee_qualifications', function (Blueprint $table) {
            $table->dropForeign('employee_qualifications_employee_id_foreign');
            $table->dropColumn('employee_id');
        });
        Schema::dropIfExists('employee_qualifications');
    }
};
