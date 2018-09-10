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
            $files[] = [
                'path' => '/storage/' . $storage_file,
                'name' => substr($storage_file, 6),
            ];
        }
        return $files;
    }
}
