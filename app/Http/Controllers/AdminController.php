<?php

namespace App\Http\Controllers;

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

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        $default_home_page = DefaultData::where('title', 'home_page')->pluck('value')->first();
        $current_locale = $request->locale_id ?? ($default_language ?? '');
        $locales = Locale::all();
        $general_infos = GeneralInfo::all();
        $pages = Page::all()->load('page_template', 'seo');
        if($current_locale && ($current_locale !== $default_language) || !$current_locale) {
            LocaleContent::translate($locales, $current_locale);
            LocaleContent::translate($general_infos, $current_locale);
            LocaleContent::translate($pages, $current_locale);
            foreach($pages as $page) {
                LocaleContent::translate(collect([$page->seo]), $current_locale);
            }
        }
        $available_block_types = InfoBlock::all();
        $available_categories = Category::all()->pluck('title');
        $design_blocks = DesignBlock::all();
        $available_design_blocks = DesignBlock::all()->pluck('title');
        $page_templates = PageTemplate::all();
        $widgets = Widget::all();
        $media = Media::getAllMedia();
        $menus = Menu::all();
        $categories = Category::all();
        return view('admin.dashboard', compact(
            'locales',
            'general_infos',
            'available_block_types',
            'design_blocks',
            'available_design_blocks',
            'page_templates',
            'pages',
            'widgets',
            'current_locale',
            'media',
            'menus',
            'default_language',
            'default_home_page',
            'categories',
            'available_categories'));
    }
}