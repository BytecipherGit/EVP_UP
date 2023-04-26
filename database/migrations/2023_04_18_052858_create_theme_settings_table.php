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
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->default(0)->comment('company id default 0 that means it is for default super admin company');
            $table->enum('key',['logo','primary_color','secondry_color','button_text_color','button_background_color','link_color'])->comment('Logo / Primary Color / Secondry Color / Button Text Color / Button Background Color / Link Color');
            $table->string('title')->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('theme_settings');
    }
};
