<?php

namespace App\Services\DesignPatterns\Interfaces;

interface TargetClassServiceContract {
    public function getTargetClass(): TargetClassContract;
    public function setTargetClass(TargetClassContract $class);
    public function createTargetClassInstance():TargetClassContract;
}