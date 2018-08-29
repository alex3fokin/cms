<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsDesignBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets_design_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order');
            $table->unsignedInteger('widget_id');
            $table->unsignedInteger('design_block_id');
            $table->unsignedInteger('parent_design_block')->nullable();

            $table->foreign('widget_id')->references('id')->on('widgets');
            $table->foreign('design_block_id')->references('id')->on('design_blocks');
            $table->foreign('parent_design_block')->references('id')->on('widgets_design_blocks');

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
        Schema::dropIfExists('widgets_design_blocks');
    }
}
