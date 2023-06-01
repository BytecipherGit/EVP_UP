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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            // $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->integer('price')->nullable();
            $table->string('plan_id')->nullable();
            $table->longText('description')->nullable()->default('text');
            $table->string('duration')->nullable();
            $table->boolean('status')->default(0)->comment('1 Active, 0 Inactive');
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
        Schema::dropIfExists('subscriptions');
    }
};
