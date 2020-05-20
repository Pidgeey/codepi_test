<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductHasCategoriesPivotTable
 * @noinspection PhpUnused
 */
class CreateProductHasCategoriesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_categories', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('category_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_categories');
    }
}
