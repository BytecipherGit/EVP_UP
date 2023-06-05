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
        Schema::create('company_subscription_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('subscription_id')->nullable()->comment('Table subscriptions id');
            // $table->unsignedBigInteger('company_subscription_id');
            // $table->foreign('company_subscription_id')->references('id')->on('company_subscriptions')->onDelete('cascade');
            $table->string('company_subscription_id')->nullable();
            $table->string('razorpay_subscription_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->enum('razorpay_subscription_status',['Created','Active','Cancelled','Expired'])->comment('Created / Active / Cancelled / Expired')->default(null);
            $table->enum('payment_status',['Active','Cancelled'])->comment('Active / Cancelled');
            $table->string('name')->nullable();
            $table->string('payment_object')->nullable();
            $table->string('razorpay_token_id')->nullable();
            $table->string('payment_price')->nullable();
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
        Schema::dropIfExists('company_subscription_payment');
    }
};
