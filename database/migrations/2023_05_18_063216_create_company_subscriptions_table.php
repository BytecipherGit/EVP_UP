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
        Schema::create('company_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('razorpay_subscription_id')->nullable();
            $table->string('subscription_id')->nullable()->comment('Table subscriptions id');
            // $table->unsignedBigInteger('subscription_id');
            // $table->foreign('subscription_id')->references('id')->on('subscriptions')->comment('Primary key from subscriptions table')->onDelete('cascade');
            $table->string('subscription_type')->nullable();
            $table->integer('price')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable()->default('text');
            $table->boolean('status')->default(0)->comment('1 Active, 0 Inactive');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
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
        Schema::dropIfExists('company_subscriptions');
    }
};
