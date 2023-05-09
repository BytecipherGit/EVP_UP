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
            $table->string('inst_name')->nullable();
            $table->string('degree')->nullable();
            $table->string('subject')->nullable();
            $table->string('duration_from')->nullable();
            $table->string('duration_to')->nullable();
            $table->string('document')->nullable();
            $table->tinyInteger('qualification_verification_type')->default('0')->comment('1=Verified, 0=Not Verified');
            $table->string('third_party_qualification_document')->nullable();
            $table->tinyInteger('third_party_qualification_verification')->default('0')->comment('1=Verified, 0=Not Verified');
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
