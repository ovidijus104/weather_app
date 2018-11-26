<?php
/**
 * Created by PhpStorm.
 * User: ovidi
 * Date: 2018-11-26
 * Time: 11:14
 */

namespace App\AgeCalculator;


class Manager
{
    public $ageCalculator;
    public $isAdult;

    public function __construct(CalculateAge $calsulateAge, IsAdult $isAdult)
    {
        $this->ageCalculator = $calsulateAge;
        $this->isAdult = $isAdult;
    }

}

