<?php

namespace App\Contracts;

interface TargetClassServiceContract {
    public function getTargetClass(): TargetClassContract;
    public function setTargetClass(TargetClassContract $class);
    public function createTargetClassInstance():TargetClassContract;
}