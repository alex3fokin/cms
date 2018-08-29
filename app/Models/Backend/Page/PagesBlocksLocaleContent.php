<?php

namespace App\Models\Backend\Page;

use Illuminate\Database\Eloquent\Model;

class PagesBlocksLocaleContent extends Model
{
    protected $fillable = [
        'value', 'pages_blocks_content_id', 'locale_id'
    ];
}
