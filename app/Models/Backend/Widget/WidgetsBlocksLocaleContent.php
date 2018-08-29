<?php

namespace App\Models\Backend\Widget;

use Illuminate\Database\Eloquent\Model;

class WidgetsBlocksLocaleContent extends Model
{
    protected $fillable = [
        'value', 'widgets_blocks_content_id', 'locale_id',
    ];
}
