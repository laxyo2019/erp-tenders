<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderBoqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_boq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('item_name',255)->nullable();
            $table->char('item_code',255)->nullable();
            $table->text('item_desc')->nullable();
            $table->char('unit',50)->nullable();
            $table->integer('quantit')->nullable();
            $table->decimal('rate',15,2)->nullable();
            $table->decimal('amount',15,2)->nullable();
            $table->text('remark')->nullable();
            $table->decimal('total',15,2)->nullable();
            $table->integer('tender_id')->nullable();
            $table->integer('account_code')->nullable();
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
        Schema::dropIfExists('tender_boq');
    }
}
