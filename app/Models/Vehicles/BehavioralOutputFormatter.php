<?php

namespace App\Models\Vehicles;

use App\Services\DesignPatterns\Interfaces\OutputContract;
use App\Services\DesignPatterns\Interfaces\TargetClassContract;

class BehavioralOutputFormatter implements OutputContract
{
    protected $targetClassInstance;

    public function setTargetClassInstance(TargetClassContract $instance): void
    {
        $this->targetClassInstance = $instance;
    }

    public function output():string
    {
        return "Behavioral Design Pattern formatter.";
    }
}