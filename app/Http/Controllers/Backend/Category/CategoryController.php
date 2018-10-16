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
            'per_page' => 'nullable|integer',
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
            'per_page' => $request->per_page,
            'parent_category' => $request->parent_category,
            'design_blocks' => implode(',', $request->design_blocks),
        ]);
        $category->parent = $category->parent();
        return response()->json(['category' => $category], 200);
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:categories',
            'title' => ['required', Rule::unique('categories')->ignore($request->id)],
            'url' => ['required', Rule::unique('categories')->ignore($request->id)],
            'per_page' => 'nullable|integer',
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
        $category = Category::find($request->id);
        $category->url = $request->url;
        $category->page_template_id = $request->page_template_id;
        $category->parent_category = $request->parent_category;
        $category->design_blocks = implode(',', $request->design_blocks);
        $category->per_page = $request->per_page;
        $category->save();

        $category->title = $request->title;

        $seo = Seo::find($category->seo_id);
        $seo->description = $request->description;
        $seo->keywords = $request->keywords;
        if(!$request->locale_id || ($request->locale_id === DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            $category->save();
            $seo->save();
        } else if($request->locale_id && ($request->locale_id !== DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            LocaleContent::createTranslatedProperty($category, ['title'], $request->locale_id);
            LocaleContent::createTranslatedProperty($seo, ['description', 'keywords'], $request->locale_id);
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

        Category::where('id', $request->id)->delete();
        Seo::where('id', $seo_id)->delete();
        return response()->json(['status' => 1], 200);
    }
}
