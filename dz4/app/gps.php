<?php
namespace App;

trait Gps
{
    protected $priceOnHour = 15;    //  рублей в час
    protected $withGPS = false;

    protected function addGps()
    {
        return $this->withGPS = true;
    }

    protected function calcGPS($timeMinutes)
    {
        return ($this->withGPS) ? min(1, ceil($timeMinutes / 60)) * $this->priceOnHour : 0;
    }
}
