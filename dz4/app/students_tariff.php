<?php
namespace App;

require_once 'tariff.php';
require_once 'gps.php';

class StudentsTariff extends Tariff
{
    use Gps;
    protected $priceDistance = 4;  // рубля за км
    protected $priceTime = 1;   //  рубль за минуту
    public $distance = 0;
    public $time = 0;

    /**
     * StudentsTariff constructor.
     * @param $distance
     * @param $time
     * @param $age
     * @param $options // для подключения услуги GPS указать 'GPS'
     */

    public function __construct($distance, $time, $age, $options)
    {
        if ($age > 25) {
            echo 'Тариф недоступен, возраст водителя должен быть не более 25 лет<br/>'.PHP_EOL;
            return;
        }
        $this->distance = $distance;
        $this->time = $time;
        $this->setAgeKoef($age);
        if ($options === 'GPS') {
            $this->addGps();
        }
    }

    public function tariffCalculation()
    {
        $baseCost = $this->distance * $this->priceDistance + $this->time * $this->priceTime;
        $addCervicesCost = $this->calcGPS($this->time);
        return  ($baseCost + $addCervicesCost) * $this->ageKoef;
    }
}
