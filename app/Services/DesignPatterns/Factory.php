<?php

namespace App\Services\DesignPatterns;

use App\Models\Vehicle;
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
        $this->description = "Describe Factory pattern";

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

    public function getTargetClassInstance(): TargetClassContract
    {
        if (empty($this->targetClass)) {
            throw new DomainException("Target class has not been set.");
        }

        $this->targetClassInstance = new (TargetClassService::getFullClassName($this->targetClass));

        return $this->targetClassInstance;
    }
}
