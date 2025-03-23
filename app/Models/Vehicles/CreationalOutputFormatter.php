<?php

namespace App\Models\Vehicles;

use App\Services\DesignPatterns\Interfaces\OutputContract;
use App\Services\DesignPatterns\Interfaces\TargetClassContract;

class CreationalOutputFormatter implements OutputContract
{
    protected $targetClassInstance;

    public function setTargetClassInstance(TargetClassContract $instance): void
    {
        $this->targetClassInstance = $instance;
    }

    public function output():string
    {
        return "Creational Design Pattern formatter.";
    }
}