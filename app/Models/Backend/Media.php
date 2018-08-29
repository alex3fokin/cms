<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    public static function getAllMedia() {
        $storage_files = Storage::disk('public')->files('media');
        $files = [];

        foreach($storage_files as $storage_file) {
            $is_image = false;
            if(substr(Storage::disk('public')->getMimeType($storage_file), 0, 5) == 'image') {
                $is_image = true;
            }
            $path = $is_image ? $storage_file : 'media/document.png';
            $path = '/storage/' . $path;
            $files[] = [
                'path' => $path,
                'name' => substr($storage_file, 6),
            ];
        }
        return $files;
    }
}
