<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_code')->unique();
            $table->date('trans_date');
            $table->string('cust_name');
            $table->decimal('total_room_price', 8, 2);
            $table->decimal('total_extra_charge', 8, 2);
            $table->decimal('final_total', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}