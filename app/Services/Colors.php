<?php

namespace App\Services;

class Colors
{
    public function load()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/colors.json'), true);

        $this->data = collect($data);

        return $this;
    }

    public function minmax($min = 50, $max = 900)
    {
        return $this->data
            ->flatMap(fn ($item) => $item[1])
            ->mapToGroups(fn ($item) => [$item[0] => $item[1]])
            ->map(fn ($val, $key) => ['intensity' => $key, 'colors' => $val])
            ->whereBetween('intensity', [$min, $max])
            ->pluck('colors')
            ->flatten();
    }

    public function all($min, $max)
    {
        if (is_numeric($min) || is_numeric($max)) {
            return $this->minmax($min, $max);
        }

        return $this->data->flatMap(function ($item) {
            return array_map(fn ($shade) => $shade[1], $item[1]);
        });
    }

    public function getRandomColor()
    {
        return $this->all(300, 600)->shuffle()->random();
    }
}