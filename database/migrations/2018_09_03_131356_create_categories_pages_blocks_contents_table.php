<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesPagesBlocksContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_pages_blocks_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('categories_pages_design_block_id');
            $table->unsignedInteger('design_blocks_info_block_id');
            $table->text('value')->nullable();

            $table->foreign('categories_pages_design_block_id', 'cpbc_cpdb')->references('id')->on('categories_pages_design_blocks');
            $table->foreign('design_blocks_info_block_id', 'cpbc_dbib')->references('id')->on('design_blocks_info_blocks');

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
        Schema::dropIfExists('categories_pages_blocks_contents');
    }
}
