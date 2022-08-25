<?php
 
namespace App\Casts;
 
use InvalidArgumentException;
use Illuminate\Support\Facades\App;
use App\Services\HijriCalculator;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
 
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
        $hijri = App::make(HijriCalculator::class);

        $hijri->setDay((int) $value[0]);
        $hijri->setMonth((int) $value[1]);
        $hijri->setYear((int) $value[2]);

        return [
            'hijri_day' => $hijri->getDay(),
            'hijri_month' => $hijri->getMonth(),
            'hijri_year' => $hijri->getYear(),
            'doc_date' => $hijri->asCarbon(),
        ];
    }
}