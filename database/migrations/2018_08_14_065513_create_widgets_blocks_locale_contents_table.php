<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsBlocksLocaleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets_blocks_locale_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('value')->nullable();
            $table->unsignedInteger('widgets_blocks_content_id');
            $table->unsignedInteger('locale_id');

            $table->foreign('widgets_blocks_content_id')->references('id')->on('widgets_blocks_contents');
            $table->foreign('locale_id')->references('id')->on('locales');

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
        Schema::dropIfExists('widgets_blocks_locale_contents');
    }
}
