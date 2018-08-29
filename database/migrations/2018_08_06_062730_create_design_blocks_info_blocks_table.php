<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesignBlocksInfoBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_blocks_info_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('design_block_id');
            $table->unsignedInteger('info_block_id');

            $table->foreign('design_block_id')->references('id')->on('design_blocks');
            $table->foreign('info_block_id')->references('id')->on('info_blocks');

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
        Schema::dropIfExists('design_blocks_info_blocks');
    }
}
