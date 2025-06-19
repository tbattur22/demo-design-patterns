<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\OutputContract;
use App\Contracts\TargetClassContract;
use Illuminate\Support\Facades\Log;
use App\Models\Vehicles\Vehicle;


class VehicleDecorated extends Vehicle
{
    protected $origVehicle;
    protected $extraMakeAndModels = [
        'New model' => ['New make 1', 'New make 2'],
    ];

    public function __construct(TargetClassContract $origVehicle)
    {
        parent::__construct();
        $this->origVehicle = $origVehicle;
    }

    /**
     * Method adds some more vehicle Make and Models to the original Target class object and returns it.
     *
     * @return array
     */
    public function getMakeAndModels():array
    {
        return array_merge($this->extraMakeAndModels, $this->origVehicle->getMakeAndModels());
    }

    /**
     * Method describes this particular vehicle instance
     *
     * @return string
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
