<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LocaleContent extends Model
{
    protected $fillable = [
        'model', 'property', 'model_id', 'locale_id', 'value'
    ];
}
