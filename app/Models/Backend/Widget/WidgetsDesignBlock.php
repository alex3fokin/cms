<?php

namespace App\Models\Backend\Widget;

use App\Models\Backend\DesignBlock;
use App\Models\Backend\LocaleContent;
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

    public function blocks_contents() {
        return $this->hasMany(WidgetsBlocksContent::class);
    }

    public function mapContent($blocks_contents) {
        $data = [];
        foreach($blocks_contents as $block_contents) {
            $value = $block_contents->value;
            $info_block_type = $block_contents->design_blocks_info_block->info_block->type;
            if($info_block_type === 'media' || $info_block_type === 'media_area') {
                $value = unserialize($value);
            }
            $data[$block_contents->design_blocks_info_block->title] = $value;
        }
        return $data;
    }

    public static function addDesignBlocks($id, $parent_id, $design_blocks)
    {
        $i = WidgetsDesignBlock::where([['parent_design_block', $parent_id], ['widget_id', $id]])->max('order') ?? 0;
        $i++;
        foreach ($design_blocks as $design_block) {
            $design_block = DesignBlock::where('title', $design_block)->get()->first();
            $widget_design_block = WidgetsDesignBlock::create([
                'order' => $i,
                'widget_id' => $id,
                'design_block_id' => $design_block->id,
                'parent_design_block' => $parent_id,
            ]);
            foreach ($design_block->info_blocks as $info_block) {
                $widget_design_block_content = WidgetsBlocksContent::create([
                    'design_blocks_info_block_id' => $info_block->id,
                    'widgets_design_block_id' => $widget_design_block->id,
                    'value' => ''
                ]);
            }
            $i++;
            if ($children_design_blocks = $design_block->children) {
                self::addDesignBlocks($id, $widget_design_block->id, $children_design_blocks->pluck('title'));
            }
        }
    }
}
