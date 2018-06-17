<?php
namespace App;

require_once 'tariff.php';
require_once 'gps.php';

class BaseTariff extends Tariff
{
    use Gps;
    protected $priceDistance = 10;  // рублей за км
    protected $priceTime = 3;   //  рубля за минуту
    protected $distance = 0;
    protected $time = 0;

    /**
     * BaseTariff constructor.
     * @param $distance
     * @param $time
     * @param $age
     * @param $options // для подключения услуги GPS указать 'GPS'
     */

    public function __construct($distance, $time, $age, $options)
    {
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
