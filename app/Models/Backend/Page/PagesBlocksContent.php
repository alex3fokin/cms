<?php

namespace App\Models\Backend\Page;

use App\Models\Backend\DesignBlocksInfoBlock;
use App\Models\Backend\LocaleContent;
use Illuminate\Database\Eloquent\Model;

class PagesBlocksContent extends Model
{
    protected $fillable = [
        'design_blocks_info_block_id', 'pages_design_block_id', 'value'
    ];

    public function design_blocks_info_block() {
        return $this->belongsTo(DesignBlocksInfoBlock::class);
    }

    public function getInputData($locale_id) {
        $info_block = $this->design_blocks_info_block;
        if($locale_id) {
            $init_data = LocaleContent::where([
                ['model', self::class],
                ['property', 'value'],
                ['model_id', $this->attributes['id']],
                ['locale_id', $locale_id]
            ])->pluck('value')->first();
            if(!$init_data) {
                $init_data = $this->attributes['value'];
            }
        } else {
            $init_data = $this->attributes['value'];
        }
        switch($info_block->info_block->type) {
            case 'media':
                $media_data = unserialize($init_data);
                $data['media_card_id'] = 'media_card_id_page_'.$this->attributes['id'];
                $data['media_file_path'] = $media_data['path'];
                $data['media_file_name_name'] = 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'].'[name]';
                $data['media_file_name_id'] = 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'];
                $data['media_file_name_value'] = $media_data['name'];
                $data['media_alt_label'] = 'media_alt_label';
                $data['media_alt_name'] = 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'].'[alt]';
                $data['media_alt_id'] = 'media_alt_id';
                $data['media_alt_value'] = $media_data['alt'];
                $data['title'] = $info_block->title;
                break;
            case 'media_area':
                $media_datas = unserialize($init_data);
                if($media_datas) {
                    $i = 0;
                    foreach($media_datas as $media_data) {
                        $data[] = [
                            'media_card_id' => 'media_card_id_page_'.$this->attributes['id'].'_'.$i,
                            'media_file_path' => $media_data['path'],
                            'media_file_name_name' => 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'].'['.$i.'][name]',
                            'media_file_name_id' => 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'],
                            'media_file_name_value' => $media_data['name'],
                            'media_alt_label' => 'media_alt_label',
                            'media_alt_name' => 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'].'['.$i.'][alt]',
                            'media_alt_id' => 'media_alt_id',
                            'media_alt_value' => $media_data['alt'],
                            'title' => $info_block->title
                        ];
                        $i++;
                    }
                } else {
                    $data[] = [
                        'media_card_id' => 'media_card_id_page_'.$this->attributes['id'].'_0',
                        'media_file_path' => '',
                        'media_file_name_name' => 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'].'[0][name]',
                        'media_file_name_id' => 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'],
                        'media_file_name_value' => '',
                        'media_alt_label' => 'media_alt_label',
                        'media_alt_name' => 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'].'[0][alt]',
                        'media_alt_id' => 'media_alt_id',
                        'media_alt_value' => '',
                        'title' => $info_block->title
                    ];
                }
                break;
            default:
                $data['value'] = $init_data;
                $data['title'] = $info_block->title;
                $data['id'] = 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'];
                $data['for'] = 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'];
                $data['name'] = 'page_'.$info_block->info_block->type.'_'.$this->attributes['id'];
        }
        return $data;
    }
}
