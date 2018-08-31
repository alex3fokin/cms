<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DefaultData;
use App\Models\Backend\InfoBlock;
use App\Models\Backend\DesignBlock;
use App\Models\Backend\GeneralInfo;
use App\Models\Backend\Locale;
use App\Models\Backend\Media;
use App\Models\Backend\Menu;
use App\Models\Backend\Page\Page;
use App\Models\Backend\Page\PageTemplate;
use App\Models\Backend\Widget\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $current_locale = $request->locale_id;
        $locales = Locale::all();
        if($current_locale) {
            $locales->each(function($locale) use ($current_locale) {
                $locale->translate($current_locale);
            });
        }
        $general_infos = GeneralInfo::all();
        $available_block_types = InfoBlock::all();
        $design_blocks = DesignBlock::all();
        $available_design_blocks = DesignBlock::all()->pluck('title');
        $page_templates = PageTemplate::all();
        $pages = Page::all()->load('page_template', 'seo');
        $widgets = Widget::all();
        $media = Media::getAllMedia();
        $menus = Menu::all();
        $default_language = DefaultData::where('title', 'Locale')->pluck('value')->first();
        $default_home_page = DefaultData::where('title', 'home_page')->pluck('value')->first();
        return view('backend.init', compact(
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
            'default_home_page'));
    }
}
