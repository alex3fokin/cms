<?php

namespace App\Http\Controllers\Backend\Widget;

use App\Http\Controllers\Controller;
use App\Models\Backend\Widget\WidgetsBlocksContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WidgetsBlocksContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function update(Request $request) {
        foreach($request->all() as $name => $value) {
            $id = substr($name, strrpos($name, '_') + 1);
            $type = substr($name,0 , strrpos($name, '_'));
            switch($type) {
                case 'widget_media':
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
                    WidgetsBlocksContent::where('id', $id)->update([
                        'value' => serialize($data),
                    ]);
                    break;
                case 'widget_media_area':
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
                    WidgetsBlocksContent::where('id', $id)->update([
                        'value' => serialize($data),
                    ]);
                    break;
                default:
                    WidgetsBlocksContent::where('id', $id)->update([
                        'value' => $value,
                    ]);
            }
        }
        return response()->json(['status' => 1],200);
    }
}
