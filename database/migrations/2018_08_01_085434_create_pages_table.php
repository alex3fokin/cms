<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('url')->unique();
            $table->boolean('published')->default(0);
            $table->unsignedInteger('seo_id');
            $table->unsignedInteger('page_template_id');

            $table->foreign('seo_id')->references('id')->on('seos')->onDelete('cascade');
            $table->foreign('page_template_id')->references('id')->on('page_templates')->onDelete('cascade');

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
        Schema::dropIfExists('pages');
    }
}
