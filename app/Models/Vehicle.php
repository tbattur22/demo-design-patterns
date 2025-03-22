<?php

namespace App\Models;

use App\Services\DesignPatterns\Interfaces\TargetClassContract;

class Vehicle implements TargetClassContract
{
    public static $makeAndModels;
    protected $id;
    private $make;
    private $model;

    public function __construct()
    {
        $this->id = uniqid();
        self::$makeAndModels = [
            'Audi' => ['A5', 'A5 Sportback', 'A6', 'A6 allroad'] ,
            'Nissan' => ['Altima', 'ARIYA', 'Aemada'],
            'Ford' => ['Bronco', 'Bronco Sport'],
            'Toyota' => ['Camry', 'Corolla', 'Prius']
        ];

    }

    public static function getMakeAndModels()
    {
        return self::$makeAndModels;
    }

    public function describe():string
    {
        $description = <<<EOD
        This is Vehicle class instance.
        Id: {$this->id}
        Make: {$this->make}
        Model: {$this->model}.
        EOD;

        return $description;
    }

    public function setMake(string $make):Vehicle
    {
        $this->make = $make;
        return $this;
    }
    public function setModel(string $model):Vehicle
    {
        $this->model = $model;
        return $this;
    }
}