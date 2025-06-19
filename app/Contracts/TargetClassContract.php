<?php
namespace App\Contracts;

interface TargetClassContract {
    public function describe():array;
    public function getMakeAndModels():array;
}
