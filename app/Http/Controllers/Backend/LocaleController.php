<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DefaultData;
use App\Models\Backend\Locale;
use App\Models\Backend\LocaleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use League\Flysystem\Adapter\Local;

class LocaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(Request $request) {
        $v = Validator::make($request->all(), [
            'title' => 'required',
            'short_code' => 'required'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        $locale = Locale::create(['short_code' => $request->short_code, 'title' => $request->title]);

        if(!DefaultData::where('title', 'locale')->count() || !DefaultData::where('title', 'locale')->pluck('value')->first()) {
            DefaultData::updateOrCreate([
                'title' => 'locale',],[
                'value' => $locale->id,
            ]);
        }

        return response()->json(['locale' => $locale],200);
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:locales',
            'title' => 'required',
            'short_code' => 'required',
            'locale_id' => 'sometimes|nullable|exists:locales,id',
        ]);

        if($v->fails()) {
            $old_locale = Locale::find($request->id);
            return response()->json(['errors' => $v->errors(), 'old_data' => $old_locale], 400);
        }

        $locale = Locale::find($request->id);
        $locale->title = $request->title;
        $locale->short_code = $request->short_code;

        if(!$request->locale_id || ($request->locale_id === DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            $locale->save();
        } else if($request->locale_id && ($request->locale_id !== DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            LocaleContent::createTranslatedProperty($locale, ['title', 'short_code'], $request->locale_id);
        }

        return response()->json(['status' => 1], 200);
    }

    public function delete(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:locales',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        if(DefaultData::where([
            ['title', 'locale'],
            ['value', $request->id]
        ])->count()) {
            DefaultData::where('title', 'locale')->delete();
            if(Locale::where('id', '!=', $request->id)->count()) {
                DefaultData::updateOrCreate([
                    'title' => 'locale',],[
                    'value' => Locale::where('id', '!=', $request->id)->pluck('id')->first(),
                ]);
            }
        }

        return response()->json(['status' => Locale::where('id', $request->id)->delete()], 200);
    }
}
