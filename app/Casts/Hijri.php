<?php
 
namespace App\Casts;
 
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;
 
class Hijri implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function get($model, $key, $value, $attributes)
    {
        return [
            $model->hijri_day,
            $model->hijri_month,
            $model->hijri_year,
        ];
    }
 
    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  \App\Models\Post  $value
     * @param  array  $attributes
     * @return array
     */
    public function set($model, $key, $value, $attributes)
    {
        return [
            'hijri_day' => (int) \Str::of($value[0])->padLeft(2, 0)->value,
            'hijri_month' => (int) \Str::of($value[1])->padLeft(2, 0)->value,
            'hijri_year' => (int) $value[2],
        ];
    }
}