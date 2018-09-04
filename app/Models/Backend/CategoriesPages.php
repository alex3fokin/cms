<?php

namespace App\Models\Backend;

use App\Models\Backend\Category\CategoriesPagesDesignBlock;
use App\Models\Backend\Category\Category;
use App\Models\Backend\Page\Page;
use Illuminate\Database\Eloquent\Model;

class CategoriesPages extends Model
{
    protected $table = 'categories_pages';

    protected $fillable = [
        'page_id', 'category_id',
    ];

    protected $appends = [
        'design_blocks'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function page() {
        return $this->belongsTo(Page::class);
    }

    public function getDesignBlocksAttribute() {
        return CategoriesPagesDesignBlock::where([['parent_design_block', null], ['categories_pages_id', $this->attributes['id']]])->orderBy('order')->get();
    }
}
