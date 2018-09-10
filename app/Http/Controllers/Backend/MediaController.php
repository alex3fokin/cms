<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function uploadFile(Request $request) {
        $v = Validator::make($request->all(), [
            'file.*' => 'required|file',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        foreach($request->file as $file) {
            $name = $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('media', $file, $name);
            $path = 'media/'.$name;
            $file = [
                'path' => '/storage/' . $path,
                'name' => $name,
            ];
        }

        return response()->json(['file' => $file],200);
    }

    public function deleteFile(Request $request) {
        $v = Validator::make($request->all(), [
            'name' => ['required', function($attribute, $value, $fail) {
                if (!Storage::disk('public')->exists('media/'.$value)) {
                    return $fail($attribute.' there is no such a file.');
                }
            },],
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        return response()->json(['status' => Storage::disk('public')->delete('media/'.$request->name)],200);
    }

    public function browseFiles(Request $request) {
        return view('backend.browse_files', ['media' => Media::getAllMedia()]);
    }
}
