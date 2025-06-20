<?php

namespace App\Services\DesignPatterns;

use App\Models\Vehicles\Vehicle;
use App\Contracts\DesignPatternContract;
use App\Contracts\TargetClassContract;
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

    /**
     * Since it is Singleton design pattern we make the constructor protected
     * to prevent from directly instantiating it
     */
    protected function __construct()
    {
        $this->name = "singleton";
        $this->category = "creational";
        $this->description = "The Singleton Method Design Pattern ensures a class has only one instance and provides a global access point to it.";
    }

    /**
     * Method returns the existing instance of Singleton class or creates one and
     * returns it if it does not exist.
     *
     * @return Singleton
     */
    public static function getInstance():Singleton
    {
        if (is_null(self::$instance)) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    /**
     * Returns existing instance of the Target Class or instantiates new instance
     * in case it does not exist
     * @param ?TargetClassContract $anotherInstance
     *
     * @return TargetClassContract
     */
    public function getTargetClassInstance(?TargetClassContract $anotherInstance): TargetClassContract
    {
        if (empty($this->targetClass)) {
            throw new DomainException("Target class has not been set.");
        }
        // return existing instance if it exists for singleton pattern
        if (is_null(self::$targetClassInstance)) {
            self::$targetClassInstance = new ($this->targetClass);
        }
        return self::$targetClassInstance;
    }
}
