<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsBlocksContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets_blocks_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('design_blocks_info_block_id');
            $table->unsignedInteger('widgets_design_block_id');
            $table->text('value')->nullable();

            $table->foreign('design_blocks_info_block_id')->references('id')->on('design_blocks_info_blocks')->onDelete('cascade');
            $table->foreign('widgets_design_block_id')->references('id')->on('widgets_design_blocks')->onDelete('cascade');

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
        Schema::dropIfExists('widgets_blocks_contents');
    }
}
