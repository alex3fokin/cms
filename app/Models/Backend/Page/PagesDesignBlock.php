<?php

namespace App\Models\Backend\Page;

use App\Models\Backend\DesignBlock;
use App\Models\Backend\Widget\Widget;
use Illuminate\Database\Eloquent\Model;

class PagesDesignBlock extends Model
{
    protected $fillable = [
        'order', 'page_id', 'widget_id', 'design_block_id', 'parent_design_block'
    ];

    protected $appends = [
        'children', 'is_widget'
    ];

    public function design_block() {
        return $this->belongsTo(DesignBlock::class);
    }

    public function widget() {
        return $this->belongsTo(Widget::class);
    }

    public function pages_blocks_contents() {
        return $this->hasMany(PagesBlocksContent::class);
    }

    public function getChildrenAttribute() {
        return self::where('parent_design_block', $this->attributes['id'])->orderBy('order')->get();
    }

    public function  getIsWidgetAttribute() {
        return $this->attributes['widget_id'] ? 1 : 0;
    }

    public function mappedInfoBlocks($locale_id) {
        $pages_design_block_id = $this->attributes['id'];
        return $this->design_block->info_blocks->mapWithKeys(function($info_block) use ($locale_id, $pages_design_block_id) {
            if($info_block->info_block->type === 'media' || $info_block->info_block->type === 'media_area') {
                $value = unserialize(PagesBlocksLocaleContent::where([
                    ['locale_id', $locale_id],
                    ['pages_blocks_content_id', PagesBlocksContent::where([
                        ['design_blocks_info_block_id', $info_block->id],
                        ['pages_design_block_id', $pages_design_block_id]
                    ])->pluck('id')->first()]
                ])->pluck('value')->first());
            } else {
                $value = PagesBlocksLocaleContent::where([
                    ['locale_id', $locale_id],
                    ['pages_blocks_content_id', PagesBlocksContent::where([
                        ['design_blocks_info_block_id', $info_block->id],
                        ['pages_design_block_id', $pages_design_block_id]
                    ])->pluck('id')->first()]
                ])->pluck('value')->first();
            }

           return [
               $info_block->title => $value
           ];
        });
    }
}
