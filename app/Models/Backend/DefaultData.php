<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class DefaultData extends Model
{
    protected $table = 'defaults';

    protected $fillable = [
        'title', 'value',
    ];
}
