<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use App\Models\Backend\Page\PageTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PageTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(Request $request) {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:page_templates',
            'view' => 'required|unique:page_templates'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        return response()->json(['page_template' => PageTemplate::create(['view' => $request->view, 'title' => $request->title])],200);
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:page_templates,id',
            'title' => ['required', Rule::unique('page_templates')->ignore($request->id)],
            'view' => ['required', Rule::unique('page_templates')->ignore($request->id)],
        ]);

        if($v->fails()) {
            $old_page_template = PageTemplate::find($request->id);
            return response()->json(['errors' => $v->errors(), 'old_data' => $old_page_template], 400);
        }

        return response()->json(['status' => PageTemplate::where('id', $request->id)->update(['view' => $request->view, 'title' => $request->title])], 200);
    }

    public function delete(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:page_templates,id',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        return response()->json(['status' => PageTemplate::where('id', $request->id)->delete()], 200);
    }
}
