<?php

namespace App\Models\Backend\Widget;

use App\Models\Backend\DesignBlocksInfoBlock;
use Illuminate\Database\Eloquent\Model;

class WidgetsBlocksContent extends Model
{
    protected $fillable = [
       'design_blocks_info_block_id', 'widgets_design_block_id',
    ];

    public function widgets_blocks_locale_contents() {
        return $this->hasMany(WidgetsBlocksLocaleContent::class);
    }

    public function design_blocks_info_block() {
        return $this->belongsTo(DesignBlocksInfoBlock::class);
    }

    public function getInputData($locale_id) {
        $info_block = $this->design_blocks_info_block;
        switch($info_block->info_block->type) {
            case 'media':
                $media_data = WidgetsBlocksLocaleContent::where([['locale_id', $locale_id], ['widgets_blocks_content_id', $this->attributes['id']]])->get()->pluck('value')->first();
                $media_data = unserialize($media_data);
                $data['media_card_id'] = 'media_card_id_'.$this->attributes['id'];
                $data['media_file_path'] = $media_data['path'];
                $data['media_file_name_name'] = $info_block->info_block->type.'_'.$this->attributes['id'].'[name]';
                $data['media_file_name_id'] = $info_block->info_block->type.'_'.$this->attributes['id'];
                $data['media_file_name_value'] = $media_data['name'];
                $data['media_alt_label'] = 'media_alt_label';
                $data['media_alt_name'] = $info_block->info_block->type.'_'.$this->attributes['id'].'[alt]';
                $data['media_alt_id'] = 'media_alt_id';
                $data['media_alt_value'] = $media_data['alt'];
                $data['title'] = $info_block->title;
                break;
            case 'media_area':
                $media_datas = WidgetsBlocksLocaleContent::where([['locale_id', $locale_id], ['widgets_blocks_content_id', $this->attributes['id']]])->get()->pluck('value')->first();
                $media_datas = unserialize($media_datas);
                if($media_datas) {
                    $i = 0;
                    foreach($media_datas as $media_data) {
                        $data[] = [
                            'media_card_id' => 'media_card_id_'.$this->attributes['id'].'_'.$i,
                            'media_file_path' => $media_data['path'],
                            'media_file_name_name' => $info_block->info_block->type.'_'.$this->attributes['id'].'['.$i.'][name]',
                            'media_file_name_id' => $info_block->info_block->type.'_'.$this->attributes['id'],
                            'media_file_name_value' => $media_data['name'],
                            'media_alt_label' => 'media_alt_label',
                            'media_alt_name' => $info_block->info_block->type.'_'.$this->attributes['id'].'['.$i.'][alt]',
                            'media_alt_id' => 'media_alt_id',
                            'media_alt_value' => $media_data['alt'],
                            'title' => $info_block->title,
                        ];
                        $i++;
                    }
                } else {
                    $data[] = [
                        'media_card_id' => 'media_card_id_'.$this->attributes['id'].'_0',
                        'media_file_path' => '',
                        'media_file_name_name' => $info_block->info_block->type.'_'.$this->attributes['id'].'[0][name]',
                        'media_file_name_id' => $info_block->info_block->type.'_'.$this->attributes['id'],
                        'media_file_name_value' => '',
                        'media_alt_label' => 'media_alt_label',
                        'media_alt_name' => $info_block->info_block->type.'_'.$this->attributes['id'].'[0][alt]',
                        'media_alt_id' => 'media_alt_id',
                        'media_alt_value' => '',
                        'title' => $info_block->title,
                    ];
                }
                break;
            default:
                $data['value'] = WidgetsBlocksLocaleContent::where([['locale_id', $locale_id], ['widgets_blocks_content_id', $this->attributes['id']]])->get()->pluck('value')->first();
                $data['title'] = $info_block->title;
                $data['id'] = $info_block->info_block->type.'_'.$this->attributes['id'];
                $data['for'] = $info_block->info_block->type.'_'.$this->attributes['id'];
                $data['name'] = $info_block->info_block->type.'_'.$this->attributes['id'];
        }
        return $data;
    }
}
