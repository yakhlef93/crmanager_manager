<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('account_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');

            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->string('status')->default('enabled');

            $table->string('global_black_list')->default('disabled');

            $table->text('comment')->nullable();

            $table->string('company_name')->unique();
            $table->string('ice')->unique();
            $table->string('website')->unique();
            
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
        Schema::dropIfExists('customers');
    }
}
