<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DefaultData;
use App\Models\Backend\GeneralInfo;
use App\Models\Backend\LocaleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GeneralInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(Request $request) {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:general_infos',
            'value' => 'required'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        return response()->json(['general_info' => GeneralInfo::create(['value' => $request->value, 'title' => $request->title])],200);
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:general_infos,id',
            'title' => ['required', Rule::unique('general_infos')->ignore($request->id)],
            'value' => 'required',
            'locale_id' => 'sometimes|nullable|exists:locales,id',
        ]);

        if($v->fails()) {
            $old_general_info = GeneralInfo::find($request->id);
            return response()->json(['errors' => $v->errors(), 'old_data' => $old_general_info], 400);
        }

        $general_info = GeneralInfo::find($request->id);
        $general_info->title = $request->title;
        $general_info->save();

        $general_info->value = $request->value;

        if(!$request->locale_id || ($request->locale_id === DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            $general_info->save();
        } else if($request->locale_id && ($request->locale_id !== DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            LocaleContent::createTranslatedProperty($general_info, ['value'], $request->locale_id);
        }

        return response()->json(['status' => 1], 200);
    }

    public function delete(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:general_infos,id',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        LocaleContent::where([
            ['model', GeneralInfo::class],
            ['model_id', $request->id]
        ])->delete();

        return response()->json(['status' => GeneralInfo::where('id', $request->id)->delete()], 200);
    }
}
