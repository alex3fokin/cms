<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use App\Models\Backend\DefaultData;
use App\Models\Backend\LocaleContent;
use App\Models\Backend\Page\PagesBlocksContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Adapter\Local;

class PagesBlocksContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'locale_id' => 'sometimes|nullable|exists:locales,id',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        if(!$request->locale_id || ($request->locale_id === DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            $is_default_locale = true;
        } else if($request->locale_id && ($request->locale_id !== DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            $is_default_locale = false;
        }

        foreach($request->all() as $name => $value) {
            if($name === 'locale_id') {
                continue;
            }
            $id = substr($name, strrpos($name, '_') + 1);
            $type = substr($name,0 , strrpos($name, '_'));
            switch($type) {
                case 'page_media':
                    $is_image = false;
                    if(substr(Storage::disk('public')->getMimeType('media/'.$value['name']), 0, 5) == 'image' ||
                        substr(Storage::disk('public')->getMimeType('media/'.$value['name']), 0, 5) == 'video') {
                        $is_image = true;
                    }
                    $path = $is_image ? $value['name'] : 'document.png';
                    $path = '/storage/media/' . $path;
                    $data = [
                        'name' => $value['name'],
                        'alt' => $value['alt'],
                        'path' => $path
                    ];
                    $value = serialize($data);
                    break;
                case 'page_media_area':
                    $data = [];
                    foreach($value as $media) {
                        $is_image = false;
                        if(substr(Storage::disk('public')->getMimeType('media/'.$media['name']), 0, 5) == 'image' ||
                            substr(Storage::disk('public')->getMimeType('media/'.$media['name']), 0, 5) == 'video') {
                            $is_image = true;
                        }
                        $path = $is_image ? $media['name'] : 'document.png';
                        $path = '/storage/media/' . $path;
                        $data[] = [
                            'name' => $media['name'],
                            'alt' => $media['alt'],
                            'path' => $path
                        ];
                    }
                    $value = serialize($data);
                    break;
            }
            $pages_blocks_content = PagesBlocksContent::find($id);
            $pages_blocks_content->value = $value;
            if($is_default_locale) {
                $pages_blocks_content->save();
            } else {
                LocaleContent::createTranslatedProperty($pages_blocks_content, ['value'], $request->locale_id);
            }
        }
        return response()->json(['status' => 1],200);
    }
}
