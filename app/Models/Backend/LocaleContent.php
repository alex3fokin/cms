<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LocaleContent extends Model
{
    protected $fillable = [
        'model', 'property', 'model_id', 'locale_id', 'value'
    ];

    public static function translate($collection, $locale_id) {
        foreach($collection as $index => $item) {
            foreach($item->attributes as $property => $value) {
                $translatedValue = self::where([
                    ['model', get_class($item)],
                    ['property', $property],
                    ['model_id', $item->id],
                    ['locale_id', $locale_id]
                ])->get()->pluck('value')->first();
                if($translatedValue) {
                    $collection[$index]->$property = $translatedValue;
                }
            }
        }
    }
}
