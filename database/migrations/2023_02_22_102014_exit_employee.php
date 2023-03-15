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
        Schema::create('exit_employee', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('do_exit');
            $table->string('decipline')->nullable();
            $table->string('reason')->nullable();
            $table->string('rating')->nullable();
            $table->string('document')->nullable();
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
        Schema::dropIfExists('exit_employee');
    }
};
