<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
    ];

    protected $appends = [
        'menu_items'
    ];

    public function getMenuItemsAttribute() {
        return MenuItem::where([['parent_menu', null], ['menu_id', $this->attributes['id']]])->orderBy('order')->get();
    }

    public function translatedMenuItems($locale_id) {
        if($locale_id) {
            return MenuItem::where([['parent_menu', null], ['menu_id', $this->attributes['id']]])->orderBy('order')->get()->each(function($menu_item) use ($locale_id) {
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
            return MenuItem::where([['parent_menu', null], ['menu_id', $this->attributes['id']]])->orderBy('order')->get();
        }
    }
}
