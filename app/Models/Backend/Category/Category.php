<?php

namespace App\Models\Backend\Category;

use App\Models\Backend\Page\PageTemplate;
use App\Models\Backend\Seo;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'title', 'url', 'seo_id', 'page_template_id', 'parent_category', 'design_blocks'
    ];

    public function page_template() {
        return $this->belongsTo(PageTemplate::class);
    }

    public function seo() {
        return $this->belongsTo(Seo::class);
    }

    public function children() {
        $children = self::where('parent_category', $this->attributes['id'])->get();
        if($children->count()) {
            return $children;
        }
        return null;
    }

    public function parent() {
        return self::where('id', $this->attributes['parent_category'])->first();
    }


}
