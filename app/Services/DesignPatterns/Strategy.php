<?php

namespace App\Services\DesignPatterns;

use App\Contracts\TargetClassContract;
use App\Services\TargetClass\TargetClassService;
use Illuminate\Database\Eloquent\Model;

/**
 * The class implements the Factory pattern
 */
class Strategy extends DesignPatternBase
{
    /**
     * Single instance of the Vehicle class
     *
     * @var $vehicleInstance
     */
    protected $targetClassInstance;

    public function __construct()
    {
        $this->name = "strategy";
        $this->category = "behavioral";
        $this->description = "The Strategy Design Pattern defines a family of algorithms, encapsulates each one, and makes them interchangeable, allowing clients to switch algorithms dynamically without altering the code structure.";
    }

    /**
     * Method returns the description
     *
     * @return string
     */
    public function describe(): string
    {
        return $this->description;   
    }
}
