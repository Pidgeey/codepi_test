<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductHasCharacteristicsPivotTable
 * @noinspection PhpUnused
 */
class CreateProductHasCharacteristicsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_characteristics', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('characteristic_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('characteristic_id')->references('id')->on('characteristics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_characteristics');
    }
}
