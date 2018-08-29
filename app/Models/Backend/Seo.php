<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'description', 'keywords',
    ];
}
