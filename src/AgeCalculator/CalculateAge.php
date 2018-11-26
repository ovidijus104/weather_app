<?php

/**
 * Created by PhpStorm.
 * User: ovidi
 * Date: 2018-11-26
 * Time: 11:06
 */

namespace App\AgeCalculator;


class CalculateAge
{
    public function getAge(string $bornDate) : int
    {
        $bornDate = new \DateTime($bornDate);
        $now = new \DateTime();
        return $now->diff($bornDate)->y;
    }

}