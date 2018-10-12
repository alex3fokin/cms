<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocaleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locale_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model');
            $table->string('property');
            $table->unsignedInteger('model_id');
            $table->unsignedInteger('locale_id');
            $table->text('value')->nullable();

            $table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');

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
        Schema::dropIfExists('locale_contents');
    }
}
