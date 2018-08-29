<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class InfoBlock extends Model
{
    protected $fillable = [
        'type'
    ];

    public function renderInfoBlockInput($type) {
        if(count(self::where('type', $type)->get())) {
            $info_block_render_method = 'render'.ucfirst($type).'InfoBlockInput';
            return $this->$info_block_render_method();
        }
    }
}
