<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\OutputContract;
use App\Contracts\TargetClassContract;
use App\Services\TargetClass\TargetClassBase;

/**
 * Vehicle class representing Target Class
 */
class Vehicle extends Model implements TargetClassContract
{
    /**
     * stores Make and Models of all available vehicle
     *
     * @var array
     */
    protected $makeAndModels;
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
    protected $make;
    /**
     * Model of the vehicle
     *
     * @var string
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        // generate unique id and store it
        $this->id = uniqid();
        // in real application the data would come from database
        $this->makeAndModels = [
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
    public function getMakeAndModels():array
    {
        return $this->makeAndModels;
    }

    /**
     * Method describes this particular vehicle instance
     *
     * @return array
     */
    public function describe():array
    {
        return [
            "description" => "Vehicle class instance",
            "Id" => $this->id,
            "Make" => $this->make,
            "Model" => $this->model
        ];
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
