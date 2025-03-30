<?php
namespace App\Contracts;

interface TargetClassContract {
    public function describe():string;
    public static function getData():array;
}