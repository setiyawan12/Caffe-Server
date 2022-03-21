<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMidtransTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midtrans_transaction_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaksi_id')->unsigned();
            $table->integer('produk_id')->unsigned();
            $table->integer('total_item')->unsigned();
            $table->text('catatan')->nullable();
            $table->integer('total_harga')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('midtrans_transaction_details');
    }
}
