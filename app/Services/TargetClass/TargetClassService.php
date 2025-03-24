<?php

namespace App\Services\TargetClass;

use App\Models\Vehicles\Vehicle;

class TargetClassService
{
    /**
     * stores vehicle Make and Models
     *
     * @var array
     */
    protected $makeModels = [];

    public function __construct()
    {
        // in real application the data would come from database
        $this->makeModels = [
            'Audi' => ['A5', 'A5 Sportback', 'A6', 'A6 allroad'] ,
            'Nissan' => ['Altima', 'ARIYA', 'Aemada'],
            'Ford' => ['Bronco', 'Bronco Sport'],
            'Toyota' => ['Camry', 'Corolla', 'Prius']
        ];
    }

    /**
     * Getter of vehicle Make and Models
     *
     * @return array
     */
    public function getMakeModels():array
    {
        return $this->makeModels;
    }

    /**
     * Instantiates Target Class instance and returns it
     *
     * @param string $make
     * @param string $model
     * @return void
     */
    public function create(string $make, string $model)
    {
        return new Vehicle($make, $model);
    }

    /**
     * Helper method to return fully qualified name of the class
     *
     * @param string $className
     * @return string
     */
    public static function getFullClassName(string $className)
    {
        return "App\\Models\\Vehicles\\{$className}";
    }
}