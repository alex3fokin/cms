<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LocaleContent extends Model
{
    protected $fillable = [
        'model', 'property', 'model_id', 'locale_id', 'value'
    ];

    public static function translate($collection, $locale_id)
    {
        if (!is_a($collection, 'Illuminate\Database\Eloquent\Collection')) {
            $collection = [$collection];
        }
        foreach ($collection as $index => $item) {
            foreach ($item->attributes as $property => $value) {
                $translatedValue = self::where([
                    ['model', get_class($item)],
                    ['property', $property],
                    ['model_id', $item->id],
                    ['locale_id', $locale_id]
                ])->get()->pluck('value')->first();
                if ($translatedValue) {
                    $collection[$index]->$property = $translatedValue;
                }
            }
        }
    }

    public static function createTranslatedProperty($model, $array_of_properties, $locale_id)
    {
        if(!is_array($array_of_properties)) {
            $array_of_properties = [$array_of_properties];
        }
        foreach($array_of_properties as $property) {
            LocaleContent::updateOrCreate([
                'model' => get_class($model),
                'property' => $property,
                'model_id' => $model->id,
                'locale_id' => $locale_id,
            ], [
                'value' => $model[$property]
            ]);
        }
    }
}
