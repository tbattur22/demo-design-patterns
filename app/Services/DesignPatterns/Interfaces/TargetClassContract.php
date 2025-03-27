<?php
namespace App\Services\DesignPatterns\Interfaces;

interface TargetClassContract {
    public function describe():string;
    public static function getData():array;
}