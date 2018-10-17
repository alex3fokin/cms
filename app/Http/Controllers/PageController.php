<?php

namespace App\Http\Controllers;

use App\Models\Backend\CategoriesPages;
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
        return $this->render($request);
    }

    public function home(Request $request) {
        $page = Page::where('title', DefaultData::where('title', 'home_page')->get()->pluck('value')->first())->get()->first();
        return $this->render($request, $page);
    }

    private function render(Request $request, Page $page = null) {
        $category = null;
        if(!$page) {
            $route_map = $this->getRouteMap();
            $path = urldecode($request->path());
            if(($route = array_search($path, array_column($route_map, 'url'))) !== false) {
                if($route_map[$route]['entity'] === 'App\Models\Backend\Page\Page') {
                    $page = $route_map[$route]['entity']::find($route_map[$route]['id']);
                } else if($route_map[$route]['entity'] === 'App\Models\Backend\Category\Category') {
                    $category = $route_map[$route]['entity']::find($route_map[$route]['id']);
                }
            }
        }
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
                LocaleContent::translate($page->seo, $locale_id);
            } else if($category) {
                LocaleContent::translate($category->seo, $locale_id);
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

            if($category->children()) {
                $categories_pages = CategoriesPages::with('page')
                    ->whereHas('page', function($q) {
                        $q->where('published', 1);
                    })
                    ->whereIn('category_id', $category->children()->pluck('id'))
                    ->get()
                    ->groupBy('page_id');
            } else {
                $categories_pages = CategoriesPages::with('page')
                    ->whereHas('page', function($q) {
                        $q->where('published', 1);
                    })
                    ->where('category_id', $category->id)
                    ->get();
            }
            $amount_of_categories_pages = $categories_pages->count();

            if($category->per_page) {
                $current_page = $request->page ? $request->page : 1;
                $categories_pages = $categories_pages->slice(($current_page - 1) * $category->per_page, $category->per_page);
            }
        }
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        return view($view, compact(
            'page',
            'category',
            'general_info',
            'locale_id',
            'menus',
            'locales',
            'default_language',
            'amount_of_categories_pages',
            'categories_pages'));
    }

    public function feedback(Request $request) {
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'tel' => 'required',
            'email' => 'required|email',
            'question' => 'required'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        Notification::route('mail', GeneralInfo::where('title', 'email')->pluck('value')->first())
            ->notify(new FeedbackNotification([
                            'name' => $request->name,
                            'phone' => $request->tel,
                            'email' => $request->email,
                            'question' => $request->question
                        ]));
        return response()->json(['status' => 1], 200);
    }

    public function sitemap() {
        $routes = $this->getRouteMap();
        return response()->view('backend.sitemap', compact('routes'))->header('Content-Type', 'text/xml');
    }

    private function getRouteMap() {
        $route_map = [];
        $categories = Category::all();
        $categories_pages = CategoriesPages::all();
        $pages_without_categories = Page::whereNotIn('id', $categories_pages->pluck('page_id')->unique()->toArray())->get();
        foreach($pages_without_categories as $page_without_category) {
            $route_map[] = [
                'url' => $page_without_category->url,
                'entity' => get_class($page_without_category),
                'id' => $page_without_category->id
            ];
        }
        foreach($categories as $category) {
            $route_map[] = [
                'url' => $category->url,
                'entity' => get_class($category),
                'id' => $category->id
            ];
            $categories_pages = CategoriesPages::where('category_id', $category->id)->get();
            foreach($categories_pages as $category_page) {
                $route_map[] = [
                    'url' => $category_page->page->url,
                    'entity' => get_class($category_page->page),
                    'id' => $category_page->page->id
                ];
            }
        }
        return $route_map;
    }
}
