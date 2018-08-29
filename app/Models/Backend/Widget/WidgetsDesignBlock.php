<?php

namespace App\Models\Backend\Widget;

use App\Models\Backend\DesignBlock;
use Illuminate\Database\Eloquent\Model;

class WidgetsDesignBlock extends Model
{
    protected $fillable = [
        'order', 'widget_id', 'design_block_id', 'parent_design_block'
    ];

    protected $appends = [
        'children',
    ];

    public function design_block() {
        return $this->belongsTo(DesignBlock::class);
    }

    public function getChildrenAttribute() {
        return self::where('parent_design_block', $this->attributes['id'])->orderBy('order')->get();
    }

    public function widgets_blocks_contents() {
        return $this->hasMany(WidgetsBlocksContent::class);
    }

    public function mappedInfoBlocks($locale_id) {
        $widgets_design_block_id = $this->attributes['id'];
        return $this->design_block->info_blocks->mapWithKeys(function($info_block) use ($locale_id, $widgets_design_block_id) {
            if($info_block->info_block->type === 'media' || $info_block->info_block->type === 'media_area') {
                $value = unserialize(WidgetsBlocksLocaleContent::where([
                    ['locale_id', $locale_id],
                    ['widgets_blocks_content_id', WidgetsBlocksContent::where([
                        ['design_blocks_info_block_id', $info_block->id],
                        ['widgets_design_block_id', $widgets_design_block_id]
                    ])->pluck('id')->first()]
                ])->pluck('value')->first());
            } else {
                $value = WidgetsBlocksLocaleContent::where([
                    ['locale_id', $locale_id],
                    ['widgets_blocks_content_id', WidgetsBlocksContent::where([
                        ['design_blocks_info_block_id', $info_block->id],
                        ['widgets_design_block_id', $widgets_design_block_id]
                    ])->pluck('id')->first()]
                ])->pluck('value')->first();
            }

            return [
                $info_block->title => $value
            ];
        });
    }
}
