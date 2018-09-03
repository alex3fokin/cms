<?php

namespace App\Models\Backend;

use App\Models\Backend\LocaleContent;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'title', 'short_code',
    ];
}
