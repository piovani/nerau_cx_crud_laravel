<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('code')->index();
            $table->uuid('client_id');
            $table->string('status')->default(\App\Models\Order::STATUS_OPEN);
            $table->decimal('subtotal_products', 20, 2);
            $table->decimal('value_freight', 20, 2);
            $table->decimal('total', 20, 2);
            $table->string('form_payment', 20, 2);
            $table->string('form_delivery', 20, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('clients');
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
}
