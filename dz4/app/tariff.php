<?php
namespace App;

require_once 'tariffplan.php';

abstract class Tariff implements TariffPlan
{
    protected const MIN_AGE = 18;
    protected const MAX_AGE = 65;
    protected const YOUNG_AGE = 22;
    protected const YOUNG_KOEF = 10; //проценты
    protected $ageKoef = 0;

    protected function testAge($age)
    {
        return ($age >= self::MIN_AGE && $age <= self::MAX_AGE);
    }

    protected function setAgeKoef($age)
    {
        $testAge = $this->testAge($age);
        if (!$testAge) {
            echo 'Водитель не соответсвует возрастным критериям (водитель не может быть младше 18 и старше 65 лет)<br/>' . PHP_EOL;
            return $this->ageKoef = 0;
        } elseif ($testAge && $age < 22) {
            echo 'При расчете применен возрастной коэффициент 10%, т.к. водитель младше 22 лет<br/>' . PHP_EOL;
            return $this->ageKoef = 1 + $this::YOUNG_KOEF / 100;
        }
        return $this->ageKoef = 1;
    }
}
