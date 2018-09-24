<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DefaultData;
use App\Models\Backend\LocaleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DefaultDataController extends Controller
{
    public function updateLocale(Request $request) {
        $v = Validator::make($request->all(), [
            'default_locale' => 'required|exists:locales,id',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
        }

        $current_default_locale = DefaultData::where('title', 'locale')->get()->first();

        if($current_default_locale->value && $current_default_locale->value !== $request->default_locale) {
            $locale_contents = LocaleContent::where('locale_id', $request->default_locale)->get();
            foreach($locale_contents as $locale_content) {
                $model = $locale_content->model;
                $tmp = $model::where('id', $locale_content->model_id)->pluck($locale_content->property)->first();
                $model::where('id', $locale_content->model_id)->update([$locale_content->property => $locale_content->value]);
                $locale_content->value = $tmp;
                $locale_content->locale_id = $request->default_locale;
                $locale_content->save();
            }
        }

        return response()->json(['status' => DefaultData::updateOrCreate(['title' => 'locale'], ['value' => $request->default_locale])],200);
    }

    public function updateHomePage(Request $request) {
        $v = Validator::make($request->all(), [
            'default_home_page' => 'required|exists:pages,title',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
        }

        return response()->json(['status' => DefaultData::updateOrCreate(['title' => 'home_page'], ['value' => $request->default_home_page])],200);
    }
}
