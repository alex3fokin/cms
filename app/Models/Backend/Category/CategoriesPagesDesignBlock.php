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

    public function categories_pages_blocks_contents() {
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

    public static function removeDesignBlocks($id)
    {
        if (!CategoriesPagesDesignBlock::where('parent_design_block', $id)->get()->count()) {
            CategoriesPagesBlocksContent::where('categories_pages_design_block_id', $id)->each(function($categories_pages_blocks_content) {
                LocaleContent::where([
                    ['model', CategoriesPagesBlocksContent::class],
                    ['model_id', $categories_pages_blocks_content->id]
                ])->delete();
            });
            CategoriesPagesBlocksContent::where('categories_pages_design_block_id', $id)->delete();
            return CategoriesPagesDesignBlock::where('id', $id)->delete();
        } else {
            CategoriesPagesDesignBlock::where('parent_design_block', $id)->get()->each(function ($categories_pages_design_block) {
                self::removeDesignBlocks($categories_pages_design_block->id);
            });
            CategoriesPagesBlocksContent::where('categories_pages_design_block_id', $id)->each(function($categories_pages_blocks_content) {
                LocaleContent::where([
                    ['model', CategoriesPagesBlocksContent::class],
                    ['model_id', $categories_pages_blocks_content->id]
                ])->delete();
            });
            CategoriesPagesBlocksContent::where('categories_pages_design_block_id', $id)->delete();
            return CategoriesPagesDesignBlock::where('id', $id)->delete();
        }
    }

    public function mappedInfoBlocks($locale_id) {
        $categories_pages_design_block_id = $this->attributes['id'];
        return $this->design_block->info_blocks->mapWithKeys(function($info_block) use ($locale_id, $categories_pages_design_block_id) {
            if($locale_id) {
                $value = LocaleContent::where([
                    ['model', CategoriesPagesBlocksContent::class],
                    ['property', 'value'],
                    ['locale_id', $locale_id],
                    ['model_id', CategoriesPagesBlocksContent::where([
                        ['design_blocks_info_block_id', $info_block->id],
                        ['widgets_design_block_id', $categories_pages_design_block_id]
                    ])->pluck('id')->first()]
                ])->pluck('value')->first();
                if(!$value) {
                    $value = CategoriesPagesBlocksContent::where([
                        ['design_blocks_info_block_id', $info_block->id],
                        ['widgets_design_block_id', $categories_pages_design_block_id]
                    ])->pluck('value')->first();
                }
            } else {
                $value = CategoriesPagesBlocksContent::where([
                    ['design_blocks_info_block_id', $info_block->id],
                    ['widgets_design_block_id', $categories_pages_design_block_id]
                ])->pluck('value')->first();
            }
            if($info_block->info_block->type === 'media' || $info_block->info_block->type === 'media_area') {
                $value = unserialize($value);
            }
            return [
                $info_block->title => $value
            ];
        });
    }
}
