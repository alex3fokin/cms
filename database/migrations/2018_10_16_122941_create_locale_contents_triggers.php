<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocaleContentsTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('create trigger `categories_locale_content_delete`
        after delete on `categories` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\Category\\\\Category\';
        end');
        DB::unprepared('create trigger `categories_contents_locale_content_delete` 
        after delete on `categories_pages_blocks_contents` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\Category\\\\CategoriesPagesBlocksContent\';
        end');
        DB::unprepared('create trigger `general_locale_content_delete` 
        after delete on `general_infos` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\GeneralInfo\';
        end');
        DB::unprepared('create trigger `locales_locale_content_delete` 
        after delete on `locales` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\Locale\';
        end');
        DB::unprepared('create trigger `menu_items_locale_content_delete` 
        after delete on `menu_items` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\MenuItem\';
        end');
        DB::unprepared('create trigger `pages_locale_content_delete` 
        after delete on `pages` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\Page\\\\Page\';
        end');
        DB::unprepared('create trigger `pages_content_locale_content_delete` 
        after delete on `pages_blocks_contents` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\Page\\\\PagesBlocksContent\';
        end');
        DB::unprepared('create trigger `seos_locale_content_delete` 
        after delete on `seos` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\Seo\';
        end');
        DB::unprepared('create trigger `widget_contents_locale_content_delete` 
        after delete on `widgets_blocks_contents` 
        for each row 
        begin 
        delete from `locale_contents` where model_id=old.id and model=\'App\\\\Models\\\\Backend\\\\Widget\\\\WidgetsBlocksContent\';
        end');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::raw('drop trigger `categories_locale_content_delete`');
        DB::raw('drop trigger `categories_contents_locale_content_delete`');
        DB::raw('drop trigger `general_locale_content_delete`');
        DB::raw('drop trigger `locales_locale_content_delete`');
        DB::raw('drop trigger `pages_locale_content_delete`');
        DB::raw('drop trigger `pages_content_locale_content_delete`');
        DB::raw('drop trigger `seos_locale_content_delete`');
        DB::raw('drop trigger `widget_contents_locale_content_delete`');
        DB::raw('drop trigger `menu_items_locale_content_delete`');
    }
}
