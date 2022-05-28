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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
          
            $table->double('price')->nullable();
            $table->enum('status',[
                \App\Enums\orderTypes::PENDING->value,
                \App\Enums\orderTypes::REFUNDED->value,
                \App\Enums\orderTypes::COMPLETED->value,
                \App\Enums\orderTypes::SHIPPED->value,
                \App\Enums\orderTypes::CANCELED->value,
            ])->default(\App\Enums\orderTypes::PENDING->value);

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
        Schema::dropIfExists('orders');
    }
};
