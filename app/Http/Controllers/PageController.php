<?php

namespace App\Http\Controllers;

use App\Models\Backend\DefaultData;
use App\Models\Backend\GeneralInfo;
use App\Models\Backend\Locale;
use App\Models\Backend\LocaleContent;
use App\Models\Backend\Menu;
use App\Models\Backend\Page\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request) {
        $page = Page::where('url', $request->path())->get()->first();
        if(!$page || !$page->published) {
            abort(404);
        }
        $general_info = GeneralInfo::all()->mapWithKeys(function($general_info_item) {
            return [$general_info_item->title => $general_info_item->value];
        });
        $menus = Menu::all()->mapWithKeys(function($menu_item) {
            return [$menu_item->title => $menu_item];
        });

        $locales = Locale::all();
        $default_language = DefaultData::where('title', 'locale')->pluck('value')->first();
        $locale_id = $request->lang ?? ($default_language ?? '');

        if($locale_id && ($locale_id !== $default_language) || !$locale_id) {
            LocaleContent::translate($locales, $locale_id);
        }

        return view($page->page_template->view, compact('page', 'general_info', 'locale_id', 'menus', 'locales'));
    }

    public function home(Request $request) {
        $page = Page::where('title', DefaultData::where('title', 'home_page')->get()->pluck('value')->first())->get()->first();
        if(!$page) {
            abort(404);
        }
        $general_info = GeneralInfo::all()->mapWithKeys(function($general_info_item) {
            return [$general_info_item->title => $general_info_item->value];
        });
        $menus = Menu::all()->mapWithKeys(function($menu_item) {
            return [$menu_item->title => $menu_item];
        });

        $locales = Locale::all();
        $default_language = DefaultData::where('title', 'locale')->pluck('value')->first();
        $locale_id = $request->lang ?? ($default_language ?? '');

        if($locale_id && ($locale_id !== $default_language) || !$locale_id) {
            LocaleContent::translate($locales, $locale_id);
        }

        return view($page->page_template->view, compact('page', 'general_info', 'locale_id', 'menus', 'locales'));
    }
}
