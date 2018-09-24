<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category\Category;
use App\Models\Backend\DefaultData;
use App\Models\Backend\DesignBlock;
use App\Models\Backend\LocaleContent;
use App\Models\Backend\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(Request $request) {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:categories',
            'url' => 'required|unique:categories',
            'keywords' => 'required',
            'description' => 'required',
            'parent_category' => 'sometimes|nullable|exists:categories,id',
            'page_template_id' => 'required|exists:page_templates,id',
            'design_blocks.*' => ['nullable', Rule::in(DesignBlock::all()->pluck('title'))],
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $seo = Seo::create([
            'keywords' => $request->keywords,
            'description' => $request->description,
        ]);

        $category = Category::create([
            'title' => $request->title,
            'url' => $request->url,
            'page_template_id' => $request->page_template_id,
            'seo_id' => $seo->id,
            'parent_category' => $request->parent_category,
            'design_blocks' => implode(',', $request->design_blocks),
        ]);
        return response()->json(['category' => $category->load('seo')], 200);
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:categories',
            'title' => ['required', Rule::unique('categories')->ignore($request->id)],
            'url' => ['required', Rule::unique('categories')->ignore($request->id)],
            'keywords' => 'required',
            'description' => 'required',
            'page_template_id' => 'required|exists:page_templates,id',
            'parent_category' => 'sometimes|nullable|exists:categories,id',
            'locale_id' => 'sometimes|nullable|exists:locales,id',
            'design_blocks.*' => ['nullable', Rule::in(DesignBlock::all()->pluck('title'))],
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $category = Category::where('id', $request->id)->get()->first();

        if(!$request->locale_id || ($request->locale_id === DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            Seo::where('id', $category->seo_id)->update([
                'keywords' => $request->keywords,
                'description' => $request->description,
            ]);
            $category->update([
                'title' => $request->title,
                'url' => $request->url,
                'page_template_id' => $request->page_template_id,
                'parent_category' => $request->parent_category,
                'design_blocks' => implode(',', $request->design_blocks),
            ]);
        } else if($request->locale_id && ($request->locale_id !== DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            LocaleContent::updateOrCreate([
                'model' => Category::class,
                'property' => 'title',
                'model_id' => $request->id,
                'locale_id' => $request->locale_id,
            ],[
                'value' => $request->title
            ]);
            LocaleContent::updateOrCreate([
                'model' => Seo::class,
                'property' => 'description',
                'model_id' => Seo::where('id', $category->seo_id)->pluck('id')->first(),
                'locale_id' => $request->locale_id,
            ],[
                'value' => $request->description
            ]);
            LocaleContent::updateOrCreate([
                'model' => Seo::class,
                'property' => 'keywords',
                'model_id' => Seo::where('id', $category->seo_id)->pluck('id')->first(),
                'locale_id' => $request->locale_id,
            ],[
                'value' => $request->keywords
            ]);
        }

        return response()->json(['status' => 1], 200);
    }

    public function delete(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:categories,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $seo_id = Category::where('id', $request->id)->get()->pluck('seo_id')->first();


        LocaleContent::where([
            ['model', Category::class],
            ['model_id', $request->id]
        ])->delete();
        LocaleContent::where([
            ['model', Seo::class],
            ['model_id', $seo_id]
        ])->delete();
        Category::where('id', $request->id)->delete();
        Seo::where('id', $seo_id)->delete();
        return response()->json(['status' => 1], 200);
    }
}
