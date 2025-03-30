<?php

namespace App\Models\Vehicles;

use App\Contracts\OutputContract;
use App\Contracts\TargetClassContract;

class BehavioralOutputFormatter implements OutputContract
{
    /**
     * store Target Class Instance
     *
     * @var TargetClassContract
     */
    protected $targetClassInstance;

    /**
     * Setter for Target Class Instance
     *
     * @param TargetClassContract $instance
     * @return void
     */
    public function setTargetClassInstance(TargetClassContract $instance): void
    {
        $this->targetClassInstance = $instance;
    }

    /**
     * Behavioral type of Design Pattern specific output formatter
     *
     * @return string
     */
    public function output():string
    {
        return "Behavioral Design Pattern formatter.";
    }
}