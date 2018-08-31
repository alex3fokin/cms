<?php

namespace App\Models\Backend;

use App\Models\Backend\LocaleContent;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'title', 'short_code',
    ];

    public function translate($locale_id) {
        foreach($this->attributes as $property => $value) {
            $translated_value = LocaleContent::where([
                ['model', self::class],
                ['property', $property],
                ['model_id', $this->attributes['id']],
                ['locale_id', $locale_id]
            ])->get()->pluck('value')->first();
            if($translated_value) {
                $this->attributes[$property] = $translated_value;
            }
        }
        return true;
    }
}
