<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category\CategoriesPagesBlocksContent;
use App\Models\Backend\DefaultData;
use App\Models\Backend\LocaleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoriesPagesBlocksContentController extends Controller
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
                    if($is_default_locale) {
                        CategoriesPagesBlocksContent::where('id', $id)->update([
                            'value' => serialize($data),
                        ]);
                    } else {
                        LocaleContent::updateOrCreate([
                            'model' => CategoriesPagesBlocksContent::class,
                            'property' => 'value',
                            'model_id' => $id,
                            'locale_id' => $request->locale_id,
                        ],[
                            'value' => serialize($data)
                        ]);
                    }
                    break;
                case 'page_media_area':
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
                    if($is_default_locale) {
                        CategoriesPagesBlocksContent::where('id', $id)->update([
                            'value' => serialize($data),
                        ]);
                    } else {
                        LocaleContent::updateOrCreate([
                            'model' => CategoriesPagesBlocksContent::class,
                            'property' => 'value',
                            'model_id' => $id,
                            'locale_id' => $request->locale_id,
                        ],[
                            'value' => serialize($data)
                        ]);
                    }
                    break;
                default:
                    if($is_default_locale) {
                        CategoriesPagesBlocksContent::where('id', $id)->update([
                            'value' => $value,
                        ]);
                    } else {
                        LocaleContent::updateOrCreate([
                            'model' => CategoriesPagesBlocksContent::class,
                            'property' => 'value',
                            'model_id' => $id,
                            'locale_id' => $request->locale_id,
                        ],[
                            'value' => $value
                        ]);
                    }
            }
        }
        return response()->json(['status' => 1],200);
    }
}
