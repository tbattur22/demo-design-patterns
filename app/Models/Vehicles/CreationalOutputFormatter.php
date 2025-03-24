<?php

namespace App\Models\Vehicles;

use App\Services\DesignPatterns\Interfaces\OutputContract;
use App\Services\DesignPatterns\Interfaces\TargetClassContract;

class CreationalOutputFormatter implements OutputContract
{
    /**
     * store target class instance
     *
     * @var TargetClassConract
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
     * Creational type of Design Pattern specific output formatter
     *
     * @return string
     */
    public function output():string
    {
        return "Creational Design Pattern formatter.";
    }
}