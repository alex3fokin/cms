<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesDesignBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_design_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order');
            $table->unsignedInteger('page_id');
            $table->unsignedInteger('design_block_id')->nullable();
            $table->unsignedInteger('parent_design_block')->nullable();
            $table->unsignedInteger('widget_id')->nullable();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('design_block_id')->references('id')->on('design_blocks')->onDelete('cascade');
            $table->foreign('parent_design_block')->references('id')->on('pages_design_blocks')->onDelete('cascade');
            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');

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
        Schema::dropIfExists('pages_design_blocks');
    }
}
