<?php

namespace App\Services\DesignPatterns;

use App\Contracts\TargetClassContract;
use App\Services\TargetClass\TargetClassService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * The class implements the Decorator pattern
 */
class Decorator extends DesignPatternBase
{
    /**
     * Single instance of the Vehicle class
     *
     * @var TargetClassContract $targetClassInstance
     */
    protected $targetClassInstance;

    public function __construct()
    {
        $this->name = "decorator";
        $this->category = "structural";
        $this->description = "The decorator design pattern is a structural design pattern that allows you to add new behavior to objects dynamically without altering their structure. It's a flexible way to extend functionality, often described as wrapping an object with additional 'decorators; to provide new features. This pattern promotes open/closed principle, where you can add new features without modifying existing code.";
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

    /**
     * Returns decorated version of orifinal instance
     * @param ?TargetClassContract $origInstance
     *
     * @return TargetClassContract
     */
    public function getTargetClassInstance(?TargetClassContract $origInstance): TargetClassContract
    {
        if (empty($this->targetClass)) {
            throw new \DomainException("Target class has not been set.");
        }
        Log::debug("Decorator::getTargetClassInstance()",[
            "origInstance" => $origInstance
        ]);
        // return existing instance if it exists for singleton pattern
        $this->targetClassInstance = new $this->targetClass($origInstance);

        return $this->targetClassInstance;
    }
}
