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
}
