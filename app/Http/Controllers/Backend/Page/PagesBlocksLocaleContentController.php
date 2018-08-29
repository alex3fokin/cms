<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use App\Models\Backend\Page\PagesBlocksLocaleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesBlocksLocaleContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function update(Request $request) {
        $locale_id = $request->locale_id ?? 1;
        foreach($request->all() as $name => $value) {
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
                    PagesBlocksLocaleContent::where([['locale_id', $locale_id], ['pages_blocks_content_id', $id]])->update([
                        'value' => serialize($data),
                    ]);
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
                    PagesBlocksLocaleContent::where([['locale_id', $locale_id], ['pages_blocks_content_id', $id]])->update([
                        'value' => serialize($data),
                    ]);
                    break;
                default:
                    PagesBlocksLocaleContent::where([['locale_id', $locale_id], ['pages_blocks_content_id', $id]])->update([
                        'value' => $value,
                    ]);
            }
        }
        return response()->json(['status' => 1],200);
    }
}
