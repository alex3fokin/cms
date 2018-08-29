<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesignBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('view')->unique()->nullable();
            $table->text('css_classes')->nullable();
            $table->text('design_blocks')->nullable();
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
        Schema::dropIfExists('design_blocks');
    }
}
