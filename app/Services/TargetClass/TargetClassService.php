<?php

namespace App\Services\TargetClass;

use App\Contracts\TargetClassServiceContract;
use App\Contracts\TargetClassContract;

class TargetClassService implements TargetClassServiceContract
{
    /**
     * stores fully qualified target class name
     *
     * @var TargetClassContract
     */
    protected $targetClass;

    public function __construct()
    {
    }

    /**
     * Getter of vehicle Make and Models
     *
     * @return array
     */
    public function getTargetClass(): TargetClassContract
    {
        return $this->targetClass;
    }

    /**
     * Instantiates Target Class instance and returns it
     *
     * @param string $make
     * @param string $model
     * @return void
     */
    public function createTargetClassInstance(): TargetClassContract
    {
        return new $this->targetClass();
    }

    public function setTargetClass(TargetClassContract $class)
    {
        $this->targetClass = $class;
    }
}