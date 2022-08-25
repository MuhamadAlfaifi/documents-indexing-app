<?php

namespace App\Services;

use Carbon\Carbon;

class HijriCalculator
{
    private $day;
    private $month;
    private $year;

    public function hijritojd($d, $m, $y){
        return (int)((11 * $y + 3) / 30) + 354 * $y + 
          30 * $m - (int)(($m - 1) / 2) + $d + 1948440 - 385;
    }

    public function timestamp()
    {
        return jdtounix(
            $this->hijritojd($this->day, $this->month, $this->year)
        );
    }

    public function gregorian()
    {
        return jdtogregorian(
            $this->hijritojd($this->day, $this->month, $this->year)
        );
    }

    public function asCarbon()
    {
        return Carbon::create(jdtogregorian(
            $this->hijritojd($this->day, $this->month, $this->year)
        ));
    }
    
    public function setDay(int $day)
    {
        $this->day = $day;
    }
    
    public function setMonth(int $month)
    {
        $this->month = $month;
    }
    
    public function setYear(int $year)
    {
        $this->year = $year;
    }

    public function getDay()
    {
        return $this->day;
    }
    
    public function getMonth()
    {
        return $this->month;
    }
    
    public function getYear()
    {
        return $this->year;
    }
}