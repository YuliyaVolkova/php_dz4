<?php
namespace App;

require_once 'tariff.php';
require_once 'gps.php';
require_once 'driverplus.php';

class Hours24Tariff extends Tariff
{
    use Gps, DriverPlus;
    protected $priceDistance = 1;  // рублей за км
    protected $price24hours = 1000;   //  рублей за 24 часа
    protected $timeMinutes = 0;
    protected $countDays = 0;
    protected $distance = 0;

    /**
     * Hours24Tariff constructor.
     * @param $distance
     * @param $time
     * @param $age
     * @param array $options для подключения услуги в массив добавить 'GPS'
     * для подключения услуги дополнительный водитель в массив добавить 'DRIVER_PLUS'
     */

    public function __construct($distance, $time, $age, array $options)
    {
        $this->distance = $distance;
        $this->timeMinutes = $time;
        $this->countDays = $this->convertMinutesToDays($time);
        $this->setAgeKoef($age);
        foreach ($options as $value) {
            $this->setOptions($value);
        }
    }
    protected function setOptions($option)
    {
        switch ($option)
        {
            case 'GPS':
                $this->addGps();
                break;
            case 'DRIVER_PLUS':
                $this->addDriver();
                break;
            default:
                return false;
        }
        return false;
    }

    /**
     * Функция округляет до 24 часов в большую сторону, но не менее 30 минут.
     * Например 24 часа 29 минут = 1 сутки. 23 часа 59 минут = 1 сутки. 24 часа 31 минута = 2 суток.
     */

    protected function convertMinutesToDays($minutes)
    {
        return max(1, ceil(($minutes - 29) / (60 * 24)));
    }
    public function tariffCalculation()
    {
        $baseCost = $this->distance * $this->priceDistance + $this->countDays * $this->price24hours;
        $addCervicesCost = $this->calcGPS($this->timeMinutes) + $this->calcDriverPlus();
        return  ($baseCost + $addCervicesCost) * $this->ageKoef;
    }
}
