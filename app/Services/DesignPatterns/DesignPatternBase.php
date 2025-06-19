<?php

namespace App\Services\DesignPatterns;

use App\Contracts\DesignPatternContract;
use App\Contracts\TargetClassContract;
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
     * Describes what category this pattern belongs to
     *
     * @var string
     */
    protected $category;

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
     * Returns the category the design pattern belongs to.
     *
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
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

    /**
     * Setter for Target Class name
     *
     * @param string $className
     * @return void
     */
    public function setTargetClass(string $className): void
    {
        $this->targetClass = $className;
    }

    /**
     * Method instantiates and returns Target Class instance
     * @param ?TargetClassContract $anotherInstance
     *
     * @return TargetClassContract
     */
    public function getTargetClassInstance(?TargetClassContract $anotherInstance): TargetClassContract
    {
        if (empty($this->targetClass)) {
            throw new \DomainException("Target class has not been set.");
        }

        $this->targetClassInstance = new $this->targetClass;

        return $this->targetClassInstance;
    }

    /**
     * Helper method to return fully qualified name of the Design Pattern class
     *
     * @param string $className
     * @return string fully qualified class name
     */
    protected function getFullClassName(string $className)
    {
        return "App\\Services\\DesignPatterns\\{$className}";
    }
}
