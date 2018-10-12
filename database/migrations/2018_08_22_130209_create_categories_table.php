<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('url')->unique();
            $table->string('design_blocks');
            $table->unsignedInteger('per_page')->nullable();
            $table->unsignedInteger('seo_id');
            $table->unsignedInteger('page_template_id');
            $table->unsignedInteger('parent_category')->nullable();

            $table->foreign('seo_id')->references('id')->on('seos')->onDelete('cascade');
            $table->foreign('page_template_id')->references('id')->on('page_templates')->onDelete('cascade');
            $table->foreign('parent_category')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('categories');
    }
}
