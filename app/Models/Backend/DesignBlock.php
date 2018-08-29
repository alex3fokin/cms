<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class DesignBlock extends Model
{
    protected $fillable = [
        'title', 'view', 'css_classes', 'design_blocks', 'is_widget'
    ];

    protected $appends = [
        'children',
    ];

    public function info_blocks() {
        return $this->hasMany(DesignBlocksInfoBlock::class);
    }

    public function getChildrenAttribute() {
        if($this->attributes['design_blocks']) {
            $children_design_blocks = explode(',', $this->attributes['design_blocks']);
            $children_design_blocks_id = [];
            foreach($children_design_blocks as $children_design_block) {
                $children_design_blocks_id[] = self::where('title', $children_design_block)->get()->pluck('id')->first();
            }
            return self::whereIn('id', $children_design_blocks_id)->get();
        }
        return null;
    }
}
