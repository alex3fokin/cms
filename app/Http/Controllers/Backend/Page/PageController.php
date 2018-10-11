<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use App\Models\Backend\CategoriesPages;
use App\Models\Backend\Category\CategoriesPagesDesignBlock;
use App\Models\Backend\Category\Category;
use App\Models\Backend\DefaultData;
use App\Models\Backend\LocaleContent;
use App\Models\Backend\Page\Page;
use App\Models\Backend\Page\PagesBlocksContent;
use App\Models\Backend\Page\PagesBlocksLocaleContent;
use App\Models\Backend\Page\PagesDesignBlock;
use App\Models\Backend\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(Request $request) {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:pages',
            'url' => 'required|unique:pages',
            'keywords' => 'required',
            'description' => 'required',
            'page_template_id' => 'required|exists:page_templates,id',
            'categories.*' => 'nullable|exists:categories,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $seo = Seo::create([
            'keywords' => $request->keywords,
            'description' => $request->description,
        ]);
        $page = Page::create([
            'title' => $request->title,
            'url' => $request->url,
            'page_template_id' => $request->page_template_id,
            'seo_id' => $seo->id,
        ]);
        if($request->categories) {
            foreach($request->categories as $category) {
                $categories_pages = CategoriesPages::create([
                    'page_id' => $page->id,
                    'category_id' => $category,
                ]);
                $design_blocks = explode(',', $categories_pages->category->design_blocks);
                if($design_blocks) {
                    CategoriesPagesDesignBlock::addDesignBlocks($categories_pages->id, null, $design_blocks);
                }
            }
        }

        return response()->json(['page' => $page], 200);
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:pages',
            'title' => ['required', Rule::unique('pages')->ignore($request->id)],
            'url' => ['required', Rule::unique('pages')->ignore($request->id)],
            'keywords' => 'required',
            'description' => 'required',
            'page_template_id' => 'required|exists:page_templates,id',
            'locale_id' => 'sometimes|nullable|exists:locales,id',
            'categories.*' => 'nullable|exists:categories,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $page = Page::find($request->id);
        $page->title = $request->title;
        $page->url = $request->url;
        $page->page_template_id = $request->page_template_id;

        $seo = Seo::find($page->seo_id);
        $seo->keywords = $request->keywords;
        $seo->description = $request->description;
        if(!$request->locale_id || ($request->locale_id === DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            $page->save();
            $seo->save();
        } else if($request->locale_id && ($request->locale_id !== DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            LocaleContent::createTranslatedProperty($page, ['title'], $request->locale_id);
            LocaleContent::createTranslatedProperty($seo, ['description', 'keywords'], $request->locale_id);
        }

        return response()->json(['status' => 1], 200);
    }

    public function delete(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:pages,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $seo_id = Page::where('id', $request->id)->get()->pluck('seo_id')->first();
        PagesDesignBlock::where([['page_id', $request->id], ['parent_design_block', null]])->get()->each(function ($page_design_block) {
            PagesDesignBlock::removeDesignBlocks($page_design_block->id);
        });
        PagesDesignBlock::removeDesignBlocks($request->id);
        LocaleContent::where([
            ['model', Page::class],
            ['model_id', $request->id]
        ])->delete();
        LocaleContent::where([
            ['model', Seo::class],
            ['model_id', $seo_id]
        ])->delete();
        CategoriesPages::where('page_id', $request->id)->each(function($categories_pages) {
            CategoriesPagesDesignBlock::where([['categories_pages_id', $categories_pages->id], ['parent_design_block', null]])->get()->each(function ($categories_pages_design_block) {
                CategoriesPagesDesignBlock::removeDesignBlocks($categories_pages_design_block->id);
            });
            CategoriesPagesDesignBlock::removeDesignBlocks($categories_pages->id);
        });
        CategoriesPages::where('page_id', $request->id)->delete();
        Page::where('id', $request->id)->delete();
        Seo::where('id', $seo_id)->delete();
        return response()->json(['status' => 1], 200);
    }

    public function updatePublicity(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:pages,id',
            'published' => ['required', Rule::in(0,1,'true', 'false', true, false)],
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        return response()->json(['status' => Page::where('id', $request->id)->update(['published' => filter_var($request->published, FILTER_VALIDATE_BOOLEAN)])],200);
    }
}
