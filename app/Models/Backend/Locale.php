<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'title', 'short_code',
    ];
}
