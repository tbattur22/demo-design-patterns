<?php
namespace App\Contracts;

use App\Contracts\TargetClassContract;

interface OutputContract {
    public function output():string;
    public function setTargetClassInstance(TargetClassContract $instance):void;
}