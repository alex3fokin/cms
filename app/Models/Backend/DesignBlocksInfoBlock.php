<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class DesignBlocksInfoBlock extends Model
{
    protected $fillable = [
        'title', 'info_block_id', 'design_block_id',
    ];

    public function info_block() {
        return $this->belongsTo(InfoBlock::class);
    }
}
