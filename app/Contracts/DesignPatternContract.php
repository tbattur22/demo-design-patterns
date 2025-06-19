<?php
namespace App\Contracts;

use App\Services\DesignPatterns\Interfaces\Describable;

interface DesignPatternContract {
    public function getName():?string;
    public function getLabel():?string;
    public function getCategory():?string;
    public function describe():string;
    public function setTargetClass(string $className):void;
    public function getTargetClassInstance(?TargetClassContract $anotherInstance):TargetClassContract;
}
