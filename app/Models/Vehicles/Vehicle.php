<?php

namespace App\Models\Vehicles;

use App\Services\DesignPatterns\Interfaces\OutputContract;
use App\Services\DesignPatterns\Interfaces\TargetClassContract;

/**
 * Vehicle class representing Target Class
 */
class Vehicle implements TargetClassContract
{
    /**
     * stores Make and Models of all available vehicle
     *
     * @var array
     */
    public static $makeAndModels;
    /**
     * store Output Formatter instance
     *
     * @var OutputContract
     */
    public $outputFormatter;
    /**
     * id of this particular instance
     *
     * @var string
     */
    protected $id;
    /**
     * Make of the vehicle
     *
     * @var string
     */
    private $make;
    /**
     * Model of the vehicle
     *
     * @var string
     */
    private $model;

    /**
     * Constructor 
     */
    public function __construct()
    {
        // generate unique id and store it
        $this->id = uniqid();
        // in real application the data would come from database
        self::$makeAndModels = [
            'Audi' => ['A5', 'A5 Sportback', 'A6', 'A6 allroad'] ,
            'Nissan' => ['Altima', 'ARIYA', 'Aemada'],
            'Ford' => ['Bronco', 'Bronco Sport'],
            'Toyota' => ['Camry', 'Corolla', 'Prius']
        ];

    }

    /**
     * Method returns array of all available Make and Models
     *
     * @return array
     */
    public static function getMakeAndModels()
    {
        return self::$makeAndModels;
    }

    /**
     * Method describes this particular vehicle instance
     *
     * @return string
     */
    public function describe():string
    {
        $description = <<<EOD
        vehicle class instance.
        Id: {$this->id}
        Make: {$this->make}
        Model: {$this->model}.
        EOD;

        return $description;
    }

    /**
     * Setter for Make of the vehicle
     *
     * @param string $make
     * @return Vehicle
     */
    public function setMake(string $make):Vehicle
    {
        $this->make = $make;
        return $this;
    }
    /**
     * Setter for Model of the vehicle
     *
     * @param string $model
     * @return Vehicle
     */
    public function setModel(string $model):Vehicle
    {
        $this->model = $model;
        return $this;
    }
    /**
     * Setter for Output Formatter
     *
     * @param OutputContract $formatter
     * @return void
     */
    public function setOutputFormatter(OutputContract $formatter)
    {
        $this->outputFormatter = $formatter;
        $this->outputFormatter->setTargetClassInstance($this);
    }
}