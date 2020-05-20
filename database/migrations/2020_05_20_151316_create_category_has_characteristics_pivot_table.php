<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCategoryHasCharacteristicsPivotTable
 * @noinspection PhpUnused
 */
class CreateCategoryHasCharacteristicsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_has_characteristics', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('characteristic_id');

            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('category_has_characteristics');
    }
}
