<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Locale;
use App\Models\Backend\Page\PagesBlocksLocaleContent;
use App\Models\Backend\Widget\WidgetsBlocksLocaleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

        return response()->json(['locale' => Locale::create(['short_code' => $request->short_code, 'title' => $request->title])],200);
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:locales',
            'title' => 'required',
            'short_code' => 'required'
        ]);

        if($v->fails()) {
            $old_locale = Locale::find($request->id);
            return response()->json(['errors' => $v->errors(), 'old_data' => $old_locale], 400);
        }

        return response()->json(['status' => Locale::where('id', $request->id)->update(['short_code' => $request->short_code, 'title' => $request->title])], 200);
    }

    public function delete(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:locales',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        PagesBlocksLocaleContent::where('locale_id', $request->id)->delete();
        WidgetsBlocksLocaleContent::where('locale_id', $request->id)->delete();

        return response()->json(['status' => Locale::where('id', $request->id)->delete()], 200);
    }
}
