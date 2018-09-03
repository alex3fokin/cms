<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesPagesDesignBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_pages_design_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order');
            $table->unsignedInteger('categories_pages_id');
            $table->unsignedInteger('design_block_id');
            $table->unsignedInteger('parent_design_block');

            $table->foreign('categories_pages_id')->references('id')->on('categories_pages');
            $table->foreign('design_block_id')->references('id')->on('design_blocks');
            $table->foreign('parent_design_block')->references('id')->on('categories_pages_design_blocks');

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
        Schema::dropIfExists('categories_pages_design_blocks');
    }
}
