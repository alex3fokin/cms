<?php

namespace App\Models\Backend\Page;

use App\Models\Backend\CategoriesPages;
use App\Models\Backend\Category\Category;
use App\Models\Backend\MenuItem;
use App\Models\Backend\Seo;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'url', 'seo_id', 'page_template_id', 'published',
    ];

    protected $appends = [
        'design_blocks', 'self_url'
    ];

    public function page_template() {
        return $this->belongsTo(PageTemplate::class);
    }

    public function seo() {
        return $this->belongsTo(Seo::class);
    }

    public function categories() {
        return $this->hasManyThrough(Category::class, CategoriesPages::class, 'page_id', 'id', 'id', 'category_id');
    }

    public function categories_pages() {
        return $this->hasMany(CategoriesPages::class, 'page_id', 'id');
    }

    public function menu_item() {
        return $this->hasOne(MenuItem::class);
    }

    public function getDesignBlocksAttribute() {
        return PagesDesignBlock::where([['parent_design_block', null], ['page_id', $this->attributes['id']]])->orderBy('order')->get();
    }

    public function getUrlAttribute() {
        $url = $this->attributes['url'];
        if($category = $this->categories->first()) {
            $url = $category->url . '/' . $url;
        }
        return $url;
    }

    public function getSelfUrlAttribute() {
        return $this->attributes['url'];
    }
}
