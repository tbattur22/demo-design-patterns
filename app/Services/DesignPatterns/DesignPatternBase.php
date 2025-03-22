<?php

namespace App\Services\DesignPatterns;

use App\Services\DesignPatterns\Interfaces\Describable;
use App\Services\DesignPatterns\Interfaces\DesignPatternContract;
use App\Services\DesignPatterns\Interfaces\TargetClassContract;
use Illuminate\Database\Eloquent\Model;

abstract class DesignPatternBase extends Model implements DesignPatternContract
{
    /**
     * Name of the design pattern
     *
     * @var string
     */
    protected $name;

    /**
     * Describes what this pattern is about
     *
     * @var string
     */
    protected $description;

    /**
     * Target class name this design pattern class works with
     * 
     * @var string
     */
    protected $targetClass;

    /**
     * Returns the name of the design pattern
     *
     * @return string|null
     */
    public function getName():?string
    {
        return $this->name;
    }

    /**
     * Returns the label of the design pattern.
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return ucfirst($this->name);
    }

    /**
     * Returns the description of the design pattern
     *
     * @return string
     */
    public function describe(): string
    {
        return $this->description;   
    }

    public function setTargetClass(string $className): void
    {
        // $targetClass = new $className();
        // if (!$targetClass instanceof DesignPatternContract) {
            
        // }
        $this->targetClass = $className;
    }

    abstract public function getTargetClassInstance():TargetClassContract;

    protected function getFullClassName(string $className)
    {
        return "App\\Services\\DesignPatterns\\{$className}";
    }
}
