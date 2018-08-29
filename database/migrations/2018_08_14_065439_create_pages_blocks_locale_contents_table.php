<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesBlocksLocaleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_blocks_locale_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('value')->nullable();
            $table->unsignedInteger('pages_blocks_content_id');
            $table->unsignedInteger('locale_id');

            $table->foreign('pages_blocks_content_id')->references('id')->on('pages_blocks_contents');
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
        Schema::dropIfExists('pages_blocks_locale_contents');
    }
}
