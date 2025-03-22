<?php
namespace App\Services\DesignPatterns\Interfaces;

use App\Services\DesignPatterns\Interfaces\Describable;

interface DesignPatternContract {
    public function getName():?string;
    public function getLabel():?string;
    public function describe():string;
    public function setTargetClass(string $className):void;
    public function getTargetClassInstance():TargetClassContract;
}
