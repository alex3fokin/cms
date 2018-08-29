<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesBlocksContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_blocks_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('design_blocks_info_block_id');
            $table->unsignedInteger('pages_design_block_id');

            $table->foreign('design_blocks_info_block_id')->references('id')->on('design_blocks_info_blocks');
            $table->foreign('pages_design_block_id')->references('id')->on('pages_design_blocks');

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
        Schema::dropIfExists('pages_blocks_contents');
    }
}
