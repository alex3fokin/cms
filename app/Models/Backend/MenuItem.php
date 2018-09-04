<?php

namespace App\Models\Backend;

use App\Models\Backend\Category\Category;
use App\Models\Backend\Page\Page;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'title', 'order', 'menu_id', 'parent_menu', 'page_id', 'category_id'
    ];

    protected $appends = [
        'children', 'main_parent'
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getChildrenAttribute()
    {
        return self::where('parent_menu', $this->attributes['id'])->orderBy('order')->get();
    }

    public function getMainParentAttribute()
    {
        if(array_key_exists('parent_menu',$this->attributes)) {
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

    public function  translatedChildren($locale_id) {
        if($locale_id) {
            return self::where('parent_menu', $this->attributes['id'])->orderBy('order')->get()->each(function($menu_item) use ($locale_id) {
                $translatedTitle = LocaleContent::where([
                    ['model', MenuItem::class],
                    ['property', 'title'],
                    ['model_id', $menu_item->id],
                    ['locale_id', $locale_id]
                ])->pluck('value')->first();
                if($translatedTitle) {
                    $menu_item->title = $translatedTitle;
                }
            });
        } else {
            return self::where('parent_menu', $this->attributes['id'])->orderBy('order')->get();
        }
    }
}
