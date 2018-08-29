<?php

namespace App\Models\Backend\Page;

use Illuminate\Database\Eloquent\Model;

class PageTemplate extends Model
{
    protected $fillable = [
        'title', 'view',
    ];
}
