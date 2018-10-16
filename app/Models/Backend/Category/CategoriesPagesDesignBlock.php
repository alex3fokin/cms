<?php

namespace App\Models\Backend\Category;

use App\Models\Backend\DesignBlock;
use App\Models\Backend\LocaleContent;
use Illuminate\Database\Eloquent\Model;

class CategoriesPagesDesignBlock extends Model
{
    protected $fillable = [
        'order', 'categories_pages_id', 'design_block_id', 'parent_design_block'
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
        return $this->hasMany(CategoriesPagesBlocksContent::class);
    }

    public static function addDesignBlocks($id, $parent_id, $design_blocks)
    {
        $i = CategoriesPagesDesignBlock::where([['parent_design_block', $parent_id], ['categories_pages_id', $id]])->max('order') ?? 0;
        $i++;
        foreach ($design_blocks as $design_block) {
            $design_block = DesignBlock::where('title', $design_block)->get()->first();
            $categories_pages_design_block = CategoriesPagesDesignBlock::create([
                'order' => $i,
                'categories_pages_id' => $id,
                'design_block_id' => $design_block->id,
                'parent_design_block' => $parent_id,
            ]);
            foreach ($design_block->info_blocks as $info_block) {
                $widget_design_block_content = CategoriesPagesBlocksContent::create([
                    'design_blocks_info_block_id' => $info_block->id,
                    'categories_pages_design_block_id' => $categories_pages_design_block->id,
                    'value' => ''
                ]);
            }
            $i++;
            if ($children_design_blocks = $design_block->children) {
                self::addDesignBlocks($id, $categories_pages_design_block->id, $children_design_blocks->pluck('title'));
            }
        }
    }
}
