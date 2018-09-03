<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
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
            'page_template_id' => 'required|exists:page_templates,id'
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
        return response()->json(['page' => $page->load('seo')], 200);
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
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $page = Page::where('id', $request->id)->get()->first();

        if(!$request->locale_id || ($request->locale_id === DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            Seo::where('id', $page->seo_id)->update([
                'keywords' => $request->keywords,
                'description' => $request->description,
            ]);
            $page->update([
                'title' => $request->title,
                'url' => $request->url,
                'page_template_id' => $request->page_template_id
            ]);
        } else if($request->locale_id && ($request->locale_id !== DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            LocaleContent::updateOrCreate([
                'model' => Page::class,
                'property' => 'title',
                'model_id' => $request->id,
                'locale_id' => $request->locale_id,
            ],[
                'value' => $request->title
            ]);
            LocaleContent::updateOrCreate([
                'model' => Seo::class,
                'property' => 'description',
                'model_id' => Seo::where('id', $page->seo_id)->pluck('id')->first(),
                'locale_id' => $request->locale_id,
            ],[
                'value' => $request->description
            ]);
            LocaleContent::updateOrCreate([
                'model' => Seo::class,
                'property' => 'keywords',
                'model_id' => Seo::where('id', $page->seo_id)->pluck('id')->first(),
                'locale_id' => $request->locale_id,
            ],[
                'value' => $request->keywords
            ]);
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
