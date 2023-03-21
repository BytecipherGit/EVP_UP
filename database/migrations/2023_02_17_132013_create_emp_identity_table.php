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
        Schema::create('emp_identity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id')->comment('emp_basicinfo Table PK');
            $table->foreign('emp_id')->references('id')->on('emp_basicinfo')->onDelete('cascade');
            $table->string('id_type')->nullable();
            $table->integer('company_id');
            $table->bigInteger('id_number')->nullable();
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
        Schema::table('emp_identity', function (Blueprint $table) {
            $table->dropForeign('emp_identity_emp_id_foreign');
            $table->dropColumn('emp_id');
        });
        Schema::dropIfExists('emp_identity');
    }
};
