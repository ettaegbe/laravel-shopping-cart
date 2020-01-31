<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(Schema::hasTable(config('cart.database.table'))){
            Schema::table(config('cart.database.table'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('identifier');
                $table->string('instance');
                $table->integer('status')->default(0)->nullable();
                $table->integer('user_id')->nullable();
                $table->double('total',8,2)->nullable();
                $table->longText('content');
                //$table->index(['identifier', 'instance']);
            });
        }else{
            Schema::create(config('cart.database.table'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('identifier');
                $table->string('instance');
                $table->integer('status')->default(0)->nullable();
                $table->integer('user_id')->nullable();
                $table->longText('content');
                $table->double('total',8,2)->nullable();
                $table->nullableTimestamps();
                $table->primary(['identifier', 'instance']);
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cart.database.table'));
    }
}
