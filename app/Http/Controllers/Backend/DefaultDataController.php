<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DefaultData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DefaultDataController extends Controller
{
    public function updateLocale(Request $request) {
        $v = Validator::make($request->all(), [
            'default_locale' => 'required|exists:locales,short_code',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
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
