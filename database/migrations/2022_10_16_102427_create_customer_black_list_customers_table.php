<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBlackListCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_black_list_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->date('birthdate')->nullable();

            $table->string('phone_number');
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->string('cin_number')->nullable();
            $table->string('cin_expiry_date')->nullable();

            $table->string('drive_licence_number')->nullable();
            $table->string('drive_licence_expiry_date')->nullable();

            $table->text('comment')->nullable();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');

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
        Schema::dropIfExists('customer_black_list_customers');
    }
}
