<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DesignPatterns\DesignPatternService;
use App\Services\TargetClass\TargetClassService;
use Illuminate\Http\Request;

/**
 * Design Patterns main controller that manipulates the target class set
 * (e.g. Vehicle class in our case)
 */
class DesignPatternsController extends Controller
{
    /**
     * stores Design Patterns Service instance
     *
     * @var DesignPatternsService
     */
    protected $designPatternsService;
    /**
     * stores Target Class Service instance
     *
     * @var TargetClassService
     */
    protected $targetClassService;

    /**
     * Constructor injects the two service instances
     *
     * @param DesignPatternService $service
     * @param TargetClassService $targetClassService
     */
    public function __construct(DesignPatternService $service, TargetClassService $targetClassService)
    {
        $this->designPatternsService = $service;
        $this->targetClassService = $targetClassService;
    }

    /**
     * Method returns all available design patterns when Home menu is clicked
     *
     * @return view main
     */
    public function main()
    {
        return view('main', [
            'patterns' => $this->designPatternsService->getDesignPatterns(),
            'home' => true
        ]);
    }

    /**
     * Method sets target class and returns a particular design pattern's content
     * in addition to all available design patterns
     *
     * @param string $pattern a specific design pattern a user selected
     * @return view main
     */
    public function designPattern(string $pattern)
    {
        $this->designPatternsService->setDesignPattern(ucfirst($pattern));
        $this->designPatternsService->designPattern->setTargetClass("Vehicle");

        return view('main', [
            'patterns' => $this->designPatternsService->getDesignPatterns(),
            'patternObj' => $this->designPatternsService->designPattern,
            'targetClassInstance' => $this->designPatternsService->designPattern->getTargetClassInstance()
        ]);
    }

    /**
     * Method handles ajax call '/create' for creational category of design patterns (Singleton and Factory)
     * when a user submits a Vehcile form ()
     *
     * @param Request $req request object
     * @return json containing created instances of target class as per design pattern logic 
     */
    public function create(Request $req)
    {
        $bodyContent = $req->toArray();
        // set selected design pattern and vehicle as target class
        $this->designPatternsService->setDesignPattern(ucfirst($bodyContent["pattern"]));
        $this->designPatternsService->designPattern->setTargetClass("Vehicle");

        // based on design pattern category we set a specific Output Formatter to be used by target class
        $outputFormatter = ucfirst($bodyContent["category"]) . "OutputFormatter";

        // create two instances of target class in order to see the behavior of Singleon and Factory design patterns
        $instance1 = $this->designPatternsService->designPattern->getTargetClassInstance();
        $instance2 = $this->designPatternsService->designPattern->getTargetClassInstance();

        // set user selected Vehicle make and model and set output formatter according to selected deisgn pattern category
        $instance1->setMake($bodyContent["selectedMake"])->setModel($bodyContent["selectedModel"]);
        $instance1->setOutputFormatter(new ($this->getOutputFormatterFullName($outputFormatter))());
        $instance2->setMake($bodyContent["selectedMake"])->setModel($bodyContent["selectedModel"]);
        $instance2->setOutputFormatter(new ($this->getOutputFormatterFullName($outputFormatter))());

        return response()->json([
            'status' => 'success',
            'instance1_description' => nl2br(htmlspecialchars($instance1->describe(), ENT_QUOTES)),
            'instance2_description' => nl2br(htmlspecialchars($instance2->describe(), ENT_QUOTES)),
            'outputFormatter' => nl2br(htmlspecialchars($instance1->outputFormatter->output(), ENT_QUOTES))
        ]);
    }

    /**
     * Method handles ajax call '/behave' for behavioral category of design patterns (Strategy)
     * when a user submits a Vehcile form
     *
     * @param Request $req request object
     * @return json containing created instances of target class as per design pattern logic 
     */
    public function behave(Request $req)
    {
        $bodyContent = $req->toArray();
        // set selected design pattern and vehicle as target class
        $this->designPatternsService->setDesignPattern(ucfirst($bodyContent["pattern"]));
        $this->designPatternsService->designPattern->setTargetClass("Vehicle");

        // set user selected Vehicle make and model and set output formatter according to selected deisgn pattern category
        $instance = $this->designPatternsService->designPattern->getTargetClassInstance()
        ->setMake($bodyContent["selectedMake"])->setModel($bodyContent["selectedModel"]);

        $outputFormatter = ucfirst($bodyContent["category"]) . "OutputFormatter";
        $instance->setOutputFormatter(new ($this->getOutputFormatterFullName($outputFormatter))());

        return response()->json([
            'status' => 'success',
            'instance1_description' => nl2br(htmlspecialchars($instance->describe(), ENT_QUOTES)),
            'outputFormatter' => nl2br(htmlspecialchars($instance->outputFormatter->output(), ENT_QUOTES))
        ]);
    }

    /**
     * Helper method to return fully qualified path of the
     * Output Formatter class
     *
     * @param string $formatterName
     * @return string full path to the formatter class
     */
    private function getOutputFormatterFullName(string $formatterName)
    {
        return "App\\Models\\Vehicles\\{$formatterName}";
    }
}
