<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category\CategoriesPagesBlocksContent;
use App\Models\Backend\Category\Category;
use App\Models\Backend\DefaultData;
use App\Models\Backend\DesignBlock;
use App\Models\Backend\GeneralInfo;
use App\Models\Backend\InfoBlock;
use App\Models\Backend\Locale;
use App\Models\Backend\LocaleContent;
use App\Models\Backend\Media;
use App\Models\Backend\Menu;
use App\Models\Backend\Page\Page;
use App\Models\Backend\Page\PageTemplate;
use App\Models\Backend\Widget\Widget;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('backend.pages.index');
    }

    public function pages()
    {
        $pages = Page::leftJoin('categories_pages', 'pages.id', '=', 'categories_pages.page_id')
            ->leftJoin('categories', 'categories_pages.category_id', '=', 'categories.id')
            ->orderBy('categories.id', 'ASC')
            ->select('pages.id', 'pages.title', 'pages.url', 'pages.published', 'categories.title as category_title')
            ->get();
        $page_templates = PageTemplate::all();
        $default_home_page = DefaultData::where('title', 'home_page')->pluck('value')->first();
        $categories = Category::all();
        return view('backend.pages.pages', compact('pages', 'page_templates', 'default_home_page', 'categories'));
    }

    public function pageTemplateEdit(PageTemplate $page_template) {
        return view('backend.pages.pages.template_edit', compact('page_template'));
    }

    public function pageEdit(Page $page, Request $request) {
        $page_templates = PageTemplate::all();
        $categories = Category::all();
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        $current_locale = $request->locale_id ?? ($default_language ?? '');
        $locales = Locale::all();

        if($current_locale && ($current_locale !== $default_language) || !$current_locale) {
            LocaleContent::translate($page, $current_locale);
            LocaleContent::translate($categories, $current_locale);
        }

        $design_blocks = DesignBlock::all();
        $widgets = Widget::all();
        $media = Media::getAllMedia();
        return view('backend.pages.pages.page_edit', compact(
            'page',
            'page_templates',
            'categories',
            'default_language',
            'current_locale',
            'locales',
            'design_blocks',
            'widgets',
            'media'));
    }

    public function categories() {
        $categories = Category::all();
        $page_templates = PageTemplate::all();
        $design_blocks = DesignBlock::all();
        return view('backend.pages.categories', compact(
            'categories',
            'page_templates',
            'design_blocks'));
    }

    public function categoryEdit(Category $category, Request $request) {
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        $current_locale = $request->locale_id ?? ($default_language ?? '');
        $locales = Locale::all();
        $design_blocks = DesignBlock::all();
        $page_templates = PageTemplate::all();
        $categories = Category::all();

        if($current_locale && ($current_locale !== $default_language) || !$current_locale) {
            LocaleContent::translate($categories, $current_locale);
            LocaleContent::translate($category, $current_locale);
        }
        return view('backend.pages.categories.category_edit', compact(
            'category',
            'locales',
            'current_locale',
            'default_language',
            'categories',
            'page_templates',
            'design_blocks'));
    }

    public function widgets() {
        $widgets = Widget::all();
        $design_blocks = DesignBlock::all();
        return view('backend.pages.widgets', compact(
            'widgets',
            'design_blocks'));
    }

    public function widgetEdit(Widget $widget, Request $request) {
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        $current_locale = $request->locale_id ?? ($default_language ?? '');
        $locales = Locale::all();
        $design_blocks = DesignBlock::all();
        return view('backend.pages.widgets.widget_edit', compact(
            'widget',
            'locales',
            'current_locale',
            'default_language',
            'design_blocks'));
    }

    public function designBlocks() {
        $design_blocks = DesignBlock::all();
        $info_blocks = InfoBlock::all();
        return view('backend.pages.design_blocks', compact(
            'design_blocks',
            'info_blocks'));
    }

    public function designBlockEdit(DesignBlock $design_block) {
        $design_blocks = DesignBlock::all();
        $info_blocks = InfoBlock::all();
        return view('backend.pages.design_blocks.design_block_edit', compact(
            'design_block',
            'design_blocks',
            'info_blocks'));
    }

    public function menus() {
        $menus = Menu::all();
        return view('backend.pages.menus', compact(
            'menus'));
    }

    public function menuEdit(Menu $menu, Request $request) {
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        $current_locale = $request->locale_id ?? ($default_language ?? '');
        $locales = Locale::all();
        $pages = Page::all();
        $categories = Category::all();

        if($current_locale && ($current_locale !== $default_language) || !$current_locale) {
            LocaleContent::translate($categories, $current_locale);
            LocaleContent::translate($pages, $current_locale);
        }
        return view('backend.pages.menus.menu_edit', compact(
            'menu',
            'locales',
            'current_locale',
            'default_language',
            'pages',
            'categories'));
    }

    public function generalInfo() {
        $general_infos = GeneralInfo::all();
        return view('backend.pages.general_info', compact(
            'general_infos'));
    }

    public function generalInfoEdit(GeneralInfo $general_info, Request $request) {
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        $current_locale = $request->locale_id ?? ($default_language ?? '');
        $locales = Locale::all();

        if($current_locale && ($current_locale !== $default_language) || !$current_locale) {
            LocaleContent::translate($general_info, $current_locale);
        }
        return view('backend.pages.general_info.general_info_edit', compact(
            'general_info',
            'locales',
            'current_locale',
            'default_language'));
    }

    public function locales() {
        $locales = Locale::all();
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        return view('backend.pages.locales', compact(
            'locales',
            'default_language'));
    }

    public function localeEdit(Locale $locale, Request $request) {
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        $current_locale = $request->locale_id ?? ($default_language ?? '');
        $locales = Locale::all();

        if($current_locale && ($current_locale !== $default_language) || !$current_locale) {
            LocaleContent::translate($locale, $current_locale);
        }
        return view('backend.pages.locales.locale_edit', compact(
            'locale',
            'locales',
            'current_locale',
            'default_language'));
    }

    public function media() {
        $media = Media::getAllMedia();
        return view('backend.pages.media', compact(
            'media'));
    }
}
