<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->unsignedInteger('order');
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('parent_menu')->nullable();
            $table->unsignedInteger('page_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();

            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('parent_menu')->references('id')->on('menu_items');
            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::dropIfExists('menu_items');
    }
}
