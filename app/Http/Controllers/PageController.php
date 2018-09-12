<?php

namespace App\Http\Controllers;

use App\Models\Backend\Category\Category;
use App\Models\Backend\DefaultData;
use App\Models\Backend\GeneralInfo;
use App\Models\Backend\Locale;
use App\Models\Backend\LocaleContent;
use App\Models\Backend\Menu;
use App\Models\Backend\Page\Page;
use App\Notifications\FeedbackNotification;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function show(Request $request) {
        $page = Page::where('url', urldecode($request->path()))->get()->first();
        return $this->render($request, $page);
    }

    public function home(Request $request) {
        $page = Page::where('title', DefaultData::where('title', 'home_page')->get()->pluck('value')->first())->get()->first();
        return $this->render($request, $page);
    }

    private function render(Request $request, Page $page = null) {
        $path = urldecode($request->path());
        $category = Category::where('url', $path)->get()->first();
        if(!($page && $page->published) && !$category) {
            abort(404);
        }
        $locales = Locale::all();
        $default_language = DefaultData::where('title', 'locale')->pluck('value')->first();
        $locale_id = $request->lang ?? ($default_language ?? '');
        $general_info = GeneralInfo::all();
        if($locale_id && ($locale_id !== $default_language) || !$locale_id) {
            LocaleContent::translate($locales, $locale_id);
            LocaleContent::translate($general_info, $locale_id);
            if($page) {
                LocaleContent::translate(collect([$page->seo]), $locale_id);
            } else if($category) {
                LocaleContent::translate(collect([$category->seo]), $locale_id);
            }
        }

        $general_info = $general_info->mapWithKeys(function($general_info_item) {
            return [$general_info_item->title => $general_info_item->value];
        });
        $menus = Menu::all()->mapWithKeys(function($menu_item) {
            return [$menu_item->title => $menu_item];
        });
        if($page) {
            $view = $page->page_template->view;
        } else if($category) {
            $view = $category->page_template->view;
        }
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        return view($view, compact(
            'page',
            'category',
            'general_info',
            'locale_id',
            'menus',
            'locales',
            'default_language'));
    }

    public function feedback(Request $request) {
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'tel' => 'required',
            'email' => 'required|email'
        ]);

        if($v->fails()) {
            return back();
        }

        Notification::route('mail', GeneralInfo::where('title', 'email')->pluck('value')->first())
            ->notify(new FeedbackNotification([
                            'name' => $request->name,
                            'phone' => $request->tel,
                            'email' => $request->email
                        ]));
        return back();
    }
}
