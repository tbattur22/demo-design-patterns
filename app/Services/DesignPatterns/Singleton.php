<?php

namespace App\Services\DesignPatterns;

use App\Models\Vehicles\Vehicle;
use App\Services\DesignPatterns\Interfaces\Describable;
use App\Services\DesignPatterns\Interfaces\DesignPatternContract;
use App\Services\DesignPatterns\Interfaces\TargetClassContract;
use App\Services\TargetClass\TargetClassService;
use DomainException;
use Illuminate\Support\Facades\Log;

// use Illuminate\Database\Eloquent\Model;

/**
 * The class implements the Singleton pattern
 */
class Singleton extends DesignPatternBase
{
    /**
     * Single instance of the class
     *
     * @var $instance
     */
    private static $instance;

    /**
     * Single instance of the Vehicle class
     *
     * @var $vehicleInstance
     */
    public static $targetClassInstance;

    protected function __construct()
    {
        $this->name = "singleton";
        $this->category = "creational";
        $this->description = "The Singleton Method Design Pattern ensures a class has only one instance and provides a global access point to it.";
    }

    /**
     * Method returns the existing vehicle instance or creates one and
     * returns it if it does not exist.
     *
     * @return Vehicle
     */
    public static function getInstance():DesignPatternContract
    {
        if (is_null(self::$instance)) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    public function getTargetClassInstance(): TargetClassContract
    {
        if (empty($this->targetClass)) {
            throw new DomainException("Target class has not been set.");
        }

        if (is_null(self::$targetClassInstance)) {
            self::$targetClassInstance = new (TargetClassService::getFullClassName($this->targetClass));
        }
        return self::$targetClassInstance;
    }
}
