<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\OutputContract;
use App\Contracts\TargetClassContract;
use Illuminate\Support\Facades\Log;
use App\Models\Vehicles\Vehicle;


class VehicleDecorated extends Vehicle
{
    /**
     * Instance of original vehicle to decorate
     * @var TargetClassContract
     */
    protected $origVehicle;

    /**
     * Extra Make and Models to add to the original vehicle instance
     * @var array
     */
    protected $extraMakeAndModels = [
        'New model' => ['New make 1', 'New make 2'],
    ];

    /**
     * Constructor take the instance of vehicle to decorate
     * @param \App\Contracts\TargetClassContract $origVehicle
     */
    public function __construct(TargetClassContract $origVehicle)
    {
        parent::__construct();
        $this->origVehicle = $origVehicle;
    }

    /**
     * Override parent method to add extra Make and Models to the original vehicle instance and returns it.
     *
     * @return array
     */
    public function getMakeAndModels():array
    {
        return array_merge($this->extraMakeAndModels, $this->origVehicle->getMakeAndModels());
    }

    /**
     * Override the parent method to add extra information
     * (extra make and models)
     *
     * @return array
     */
    public function describe():array
    {
        $extraMakeAndModels = json_encode($this->extraMakeAndModels, true);

        return [
            "description" => "Vehicle class instance",
            "Id" => $this->id,
            "Make" => $this->make,
            "Model" => $this->model,
            "Extra_Make_Models" => $extraMakeAndModels
        ];
    }
}
