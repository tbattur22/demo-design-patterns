<?php
namespace App\Services\DesignPatterns\Interfaces;

use App\Services\DesignPatterns\Interfaces\TargetClassContract;

interface OutputContract {
    public function output():string;
    public function setTargetClassInstance(TargetClassContract $instance):void;
}