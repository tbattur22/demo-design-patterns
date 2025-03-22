<?php

namespace App\Services\TargetClass;

use App\Models\Vehicle;

class TargetClassService
{
    protected $makeModels = [];

    public function __construct()
    {
        $this->makeModels = [
            'Audi' => ['A5', 'A5 Sportback', 'A6', 'A6 allroad'] ,
            'Nissan' => ['Altima', 'ARIYA', 'Aemada'],
            'Ford' => ['Bronco', 'Bronco Sport'],
            'Toyota' => ['Camry', 'Corolla', 'Prius']
        ];
    }

    public function getMakeModels():array
    {
        return $this->makeModels;
    }

    public function create(string $make, string $model)
    {
        file_put_contents("/tmp/debug", $make);
        return new Vehicle($make, $model);
    }

    public static function getFullClassName(string $className)
    {
        return "App\\Models\\{$className}";
    }
}