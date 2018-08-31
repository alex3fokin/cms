<?php

use App\Models\Backend\Admin;
use App\Models\Backend\DefaultData;
use App\Models\Backend\InfoBlock;
use App\Models\Backend\Locale;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);
        if(InfoBlock::all()->count() === 0) {
            $block_types = [
                'text', 'textarea', 'media', 'media_area',
            ];

            foreach($block_types as $block_type) {
                InfoBlock::create([
                    'type' => $block_type,
                ]);
            }
        }
        DefaultData::create([
            'title' => 'Locale',
            'value' => 'default',
        ]);
    }
}
