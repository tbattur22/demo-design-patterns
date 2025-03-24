<?php

namespace App\Services\DesignPatterns;

use App\Models\Vehicles\Vehicle;
use App\Services\DesignPatterns\Interfaces\Describable;
use App\Services\DesignPatterns\Interfaces\TargetClassContract;
use App\Services\TargetClass\TargetClassService;
use Illuminate\Database\Eloquent\Model;

/**
 * The class implements the Factory pattern
 */
class Factory extends DesignPatternBase
{
    /**
     * Single instance of the Vehicle class
     *
     * @var $vehicleInstance
     */
    protected $targetClassInstance;

    public function __construct()
    {
        $this->name = "factory";
        $this->category = "creational";
        $this->description = "The Factory Method Design Pattern is a creational design pattern used in software development. It provides an interface for creating objects in a superclass while allowing subclasses to specify the types of objects they create.";

    }

    /**
     * print method implementation required by Design Pattern Interface
     *
     * @return void
     */
    public function describe(): string
    {
        return $this->description;   
    }

    /**
     * Method instantiates and returns Target Class instance
     *
     * @return TargetClassContract
     */
    public function getTargetClassInstance(): TargetClassContract
    {
        if (empty($this->targetClass)) {
            throw new DomainException("Target class has not been set.");
        }

        $this->targetClassInstance = new (TargetClassService::getFullClassName($this->targetClass));

        return $this->targetClassInstance;
    }
}
