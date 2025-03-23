<?php

namespace App\Services\DesignPatterns;

use App\Services\DesignPatterns\Interfaces\DesignPatternContract;
use App\Services\DesignPatterns\Singleton;
use App\Services\DesignPatterns\Factory;
use InvalidArgumentException;

class DesignPatternService
{
    protected $designPatterns = [];
    public $designPattern;

    public function __construct()
    {
        $this->designPatterns = [
            'singleton' => Singleton::getInstance(null, null),
            'factory' => new Factory(),
            'strategy' => new Strategy()
        ];        
    }

    public function getDesignPatterns():array
    {
        return $this->designPatterns;
    }

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

    protected function getFullClassName(string $className)
    {
        return "App\\Services\\DesignPatterns\\{$className}";
    }
}