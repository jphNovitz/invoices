<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference');

            $table->timestamps();


            $table->unsignedBigInteger( 'client_id');
            $table->foreign('client_id')
                ->references('id')->on('client')
                ->onDelete('cascade')
            ;
            $table->unsignedBigInteger( 'user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
            ;

//            $table->integer('client_id');
//            $table->foreign('client_id')->references('id')->on('client');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
