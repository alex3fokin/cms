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

    public static function addDesignBlocks($id, $parent_id, $design_blocks)
    {
        $i = PagesDesignBlock::where('parent_design_block', $parent_id)->max('order') ?? 0;
        $i++;
        foreach ($design_blocks as $design_block) {
            $design_block = DesignBlock::where('title', $design_block)->get()->first();
            $page_design_block = PagesDesignBlock::create([
                'order' => $i,
                'page_id' => $id,
                'design_block_id' => $design_block->id,
                'parent_design_block' => $parent_id,
            ]);
            foreach ($design_block->info_blocks as $info_block) {
                $page_design_block_content = PagesBlocksContent::create([
                    'design_blocks_info_block_id' => $info_block->id,
                    'pages_design_block_id' => $page_design_block->id,
                ]);
            }
            $i++;
            if ($children_design_blocks = $design_block->children) {
                self::addDesignBlocks($id, $page_design_block->id, $children_design_blocks->pluck('title'));
            }
        }
    }

    public static function removeDesignBlocks($id)
    {
        if (!PagesDesignBlock::where('parent_design_block', $id)->get()->count()) {
            PagesBlocksContent::where('pages_design_block_id', $id)->delete();
            return PagesDesignBlock::where('id', $id)->delete();
        } else {
            PagesDesignBlock::where('parent_design_block', $id)->get()->each(function ($page_design_block) {
                self::removeDesignBlocks($page_design_block->id);
            });
            PagesBlocksContent::where('pages_design_block_id', $id)->delete();
            return PagesDesignBlock::where('id', $id)->delete();
        }
    }

    public function mappedInfoBlocks($locale_id = null) {
        $pages_design_block_id = $this->attributes['id'];
        return $this->design_block->info_blocks->mapWithKeys(function($info_block) use ($locale_id, $pages_design_block_id) {
            if($info_block->info_block->type === 'media' || $info_block->info_block->type === 'media_area') {
                $value = unserialize(PagesBlocksContent::where([
                        ['design_blocks_info_block_id', $info_block->id],
                        ['pages_design_block_id', $pages_design_block_id]
                    ])->pluck('value')->first());
            } else {
                $value = PagesBlocksContent::where([
                    ['design_blocks_info_block_id', $info_block->id],
                    ['pages_design_block_id', $pages_design_block_id]
                ])->pluck('value')->first();
            }

           return [
               $info_block->title => $value
           ];
        });
    }
}
