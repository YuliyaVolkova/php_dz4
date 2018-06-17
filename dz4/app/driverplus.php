<?php
namespace App;

trait DriverPlus
{
    protected $baseCost = 100; // Дополнительнительный водитель 100 руб.
    protected $driverPlus = false;
    protected function addDriver()
    {
        $this->driverPlus = true;
    }
    protected function calcDriverPlus()
    {
        return $this->driverPlus ? $this->baseCost : 0;
    }
}
