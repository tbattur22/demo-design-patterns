<?php

namespace App\Services\DesignPatterns;

use App\Contracts\DesignPatternContract;
use App\Contracts\TargetClassContract;
use App\Models\Vehicles\VehicleDecorated;
use App\Services\DesignPatterns\Singleton;
use App\Services\DesignPatterns\Factory;
use InvalidArgumentException;

class DesignPatternService
{
    /**
     * stores associative array of design pattern and their instance
     *
     * @var array
     */
    protected $designPatterns = [];
    /**
     * stores a Design Pattern instance
     *
     * @var DesignPatternContract
     */
    public $designPattern;

    /**
     * Constructor initializes available design patterns
     */
    public function __construct()
    {
        $this->designPatterns = [
            'singleton' => Singleton::getInstance(),
            'factory' => new Factory(),
            'strategy' => new Strategy(),
            'decorator' => new Decorator(),
        ];
    }

    /**
     * Method returns all available Design Patterns array
     *
     * @return array
     */
    public function getDesignPatterns():array
    {
        return $this->designPatterns;
    }

    /**
     * Setter for a specific Deisgn Pattern instance
     *
     * @param string $designPattern
     * @param TargetClassContract $vehicle
     * @return void
     */
    public function setDesignPattern(string $designPattern)
    {
        if ($designPattern === "Singleton") {
            $designPatternInstance = Singleton::getInstance();
        } else {
            $designPatternInstance = new ($this->getFullClassName($designPattern));
        }

        if ($designPatternInstance instanceof DesignPatternContract) {
            $this->designPattern = $designPatternInstance;
        } else {
            throw new InvalidArgumentException("Invalid Design Pattern!");
        }
    }

    /**
     * Helper method to return fully qualified name of the class
     *
     * @param string $className
     * @return string fully qualified class name
     */
    protected function getFullClassName(string $className)
    {
        return "App\\Services\\DesignPatterns\\{$className}";
    }
}
