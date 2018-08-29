<?php

namespace App\Models\Backend\Widget;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = [
        'title',
    ];

    protected $appends = [
        'design_blocks'
    ];

    public function getDesignBlocksAttribute() {
        return WidgetsDesignBlock::where([['parent_design_block', null], ['widget_id', $this->attributes['id']]])->orderBy('order')->get();
    }
}
