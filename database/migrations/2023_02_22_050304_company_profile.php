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
        Schema::create('company_profile', function (Blueprint $table) {
            $table->id();
            $table->string('com_name')->nullable();
            $table->string('brand_name');
            $table->string('website');
            $table->string('domain_name');
            $table->string('industry');
            $table->integer('phone')->unsigned()->nullable()->default(12);
            $table->string('logo')->nullable();
            $table->longText('description')->nullable()->default('text');
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
        Schema::dropIfExists('company_profile');
    }
};
