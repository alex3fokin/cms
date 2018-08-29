<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
            $is_image = false;
            if(substr($file->getMimeType(), 0, 5) == 'image') {
                $is_image = true;
            }
            if($is_image) {
                $path = Storage::disk('public')->putFile('media', $file);
                $path_arr = explode('/', $path);
                $name = array_pop($path_arr);
            } else {
                $name = $file->getClientOriginalName();
                Storage::disk('public')->putFileAs('media', $file, $name);
                $path = 'media/document.png';
            }
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
}
