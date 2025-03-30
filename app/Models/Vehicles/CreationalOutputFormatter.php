<?php

namespace App\Models\Vehicles;

use App\Contracts\OutputContract;
use App\Contracts\TargetClassContract;

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
     * @return
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