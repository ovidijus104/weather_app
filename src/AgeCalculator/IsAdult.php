<?php

namespace App\AgeCalculator;
/**
 * Created by PhpStorm.
 * User: ovidi
 * Date: 2018-11-26
 * Time: 10:48
 */
class IsAdult
{
    public function isAdult(int $age)
    {
        if ($age > 18)
            return "Suaugęs";
        else
            return "Vaikas";
    }

}