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
        Schema::create('employee_offer_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('employee_id')->comment('employee Table PK');
            $table->foreign('employee_id')->references('id')->on('employee')->comment('Id form employee')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('comment')->nullable()->default('text');
            $table->string('document')->nullable();
            $table->enum('status',['withdrow','accepted','declined','not_joined','joined'])->comment('Withdrow / Accepted / Declined / Not Joined / Joined');
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
        Schema::dropIfExists('employee_offer_statuses');
    }
};
