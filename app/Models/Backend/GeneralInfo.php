<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    protected $fillable = [
        'value', 'title',
    ];
}
