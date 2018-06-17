<?php
namespace App;

require_once 'tariff.php';
require_once 'gps.php';
require_once 'driverplus.php';

class HourTariff extends Tariff
{
    use Gps, DriverPlus;
    protected $priceHour = 200;   //  рублей за 60 минут
    protected $timeMinutes = 0;
    protected $timeHours = 0;

    /**
     * HourTariff constructor.
     * @param $time // в минутах
     * @param $age
     * @param array $options для подключения услуги в массив добавить 'GPS'
     * для подключения услуги дополнительный водитель в массив добавить 'DRIVER_PLUS'
     */

    public function __construct($time, $age, array $options)
    {
        $this->timeMinutes = $time;
        $this->timeHours = $this->convertMinutesToHours($time);
        $this->setAgeKoef($age);
        foreach ($options as $value) {
            $this->setOptions($value);
        }
    }
    protected function convertMinutesToHours($minutes)
    {
        return ceil($minutes / 60);
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
    public function tariffCalculation()
    {
        $baseCost = $this->timeHours * $this->priceHour;
        $addCervicesCost = $this->calcGPS($this->timeMinutes) + $this->calcDriverPlus();
        return  ($baseCost + $addCervicesCost) * $this->ageKoef;
    }
}
