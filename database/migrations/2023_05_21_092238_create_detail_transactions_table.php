<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trans_id')->constrained('transactions');
            $table->foreignId('room_id')->constrained('rooms');
            $table->integer('days');
            $table->decimal('sub_total_room', 8, 2);
            $table->decimal('extra_charge', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_transactions');
    }
}
