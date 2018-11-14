<?php

/**
 * Created by PhpStorm.
 * User: ovidi
 * Date: 2018-11-14
 * Time: 12:20
 */
namespace App\Validators;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class DateValidator
{

    /**
     * @var string
     */
    private $date;

    /**
     * @var array
     */
    private $error = array();

    /**
     * DateValidator constructor.
     * @param string $date
     */
    public function __construct(string $date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getError(): ?array
    {
        return $this->error;
    }


    /**
     * @return bool
     */
    private function setErrors(){
        $validator = Validation::createValidator();

        $errors = $validator->validate(
            $this->date,
            $this->dateConstraint
        );

        if (count($errors) > 0) {
            array_push($this->error, $errors[0]->getMessage());
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function validateDateFormat(): bool {
        $this->dateConstraint = new Assert\Date();
        $this->dateConstraint->message = 'Klaidingas datos formatas';

        return $this->setErrors();
    }

    /**
     * @return bool
     */
    public function validateCurrentDate(): bool {
        $this->dateConstraint = new Assert\GreaterThanOrEqual(date("Y-m-d"));
        $this->dateConstraint->validatedBy($this->date);
        $this->dateConstraint->message = 'Pasirinkta data yra praejusi';
        return $this->setErrors();
    }
}