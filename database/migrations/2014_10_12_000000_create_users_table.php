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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('org_name');
            $table->string('org_web');  
            $table->string('designation');
            $table->string('department');
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->integer('pin');  
            $table->string('role');
            $table->string('brand_name')->nullable();
            $table->string('domain_name')->nullable();
            $table->string('industry')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('company_logo')->nullable();
            $table->longText('description')->nullable();
            $table->string('cor_office_address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default('0')->comment('1=Verified, 0=Pending');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
