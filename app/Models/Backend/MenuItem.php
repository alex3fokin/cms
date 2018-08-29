<?php

namespace App\Models\Backend;

use App\Models\Backend\Page\Page;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'title', 'order', 'menu_id', 'parent_menu', 'page_id'
    ];

    protected $appends = [
        'children', 'main_parent'
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }

    public function getChildrenAttribute()
    {
        return self::where('parent_menu', $this->attributes['id'])->orderBy('order')->get();
    }

    public function getMainParentAttribute()
    {
        if(!$this->attributes['parent_menu']) {
            return $this;
        } else {
            $parent = $this;
            while($parent->parent_menu) {
                $parent = self::where('id', $parent->parent_menu)->get()->first();
            }
            return $parent;
        }
    }
}
