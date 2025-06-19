<?php

namespace App\Http\Controllers;

use App\Contracts\TargetClassContract;
use App\Http\Controllers\Controller;
use App\Services\DesignPatterns\DesignPatternService;
use App\Services\TargetClass\TargetClassService;
use App\Models\Vehicles\Vehicle;
use App\Models\Vehicles\VehicleDecorated;
use App\Models\Vehicles\CreationalOutputFormatter;
use App\Models\Vehicles\BehavioralOutputFormatter;
use App\Models\Vehicles\StructuralOutputFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

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
     * Maps Output formatter class name with fully qualified class name
     *
     * @var array
     */
    protected $outputFormatters = [
        'CreationalOutputFormatter' => CreationalOutputFormatter::class,
        'BehavioralOutputFormatter' => BehavioralOutputFormatter::class,
        'StructuralOutputFormatter' => StructuralOutputFormatter::class,
    ];
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
     * @return view index
     */
    public function index()
    {
        return view('index', [
            'patterns' => $this->designPatternsService->getDesignPatterns(),
            'home' => true
        ]);
    }

    /**
     * Method sets target class and returns a particular design pattern's content
     * in addition to all available design patterns
     *
     * @param string $pattern a specific design pattern a user selected
     * @return view index
     */
    public function designPattern(string $pattern)
    {
        $targetClass = Vehicle::class;
        $targetInstance = null;

        if ($pattern === "decorator") {
            $targetClass = VehicleDecorated::class;
            $targetInstance = new VehicleDecorated(new Vehicle());
        }

        $this->designPatternsService->setDesignPattern(ucfirst($pattern));
        $this->designPatternsService->designPattern->setTargetClass($targetClass);

        return view('index', [
            'patterns' => $this->designPatternsService->getDesignPatterns(),
            'patternObj' => $this->designPatternsService->designPattern,
            'targetClassInstance' => $this->designPatternsService->designPattern->getTargetClassInstance($targetInstance)
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
        $this->designPatternsService->designPattern->setTargetClass(Vehicle::class);

        // based on design pattern category we set a specific Output Formatter to be used by target class
        $outputFormatter = ucfirst($bodyContent["category"]) . "OutputFormatter";

        // create two instances of target class in order to see the behavior of Singleon and Factory design patterns
        $instance1 = $this->designPatternsService->designPattern->getTargetClassInstance(null);
        $instance2 = $this->designPatternsService->designPattern->getTargetClassInstance(null);

        // set user selected Vehicle make and model and set output formatter according to selected deisgn pattern category
        $instance1->setMake($bodyContent["selectedMake"])->setModel($bodyContent["selectedModel"]);
        $instance1->setOutputFormatter(new ($this->getOutputFormatterFullName($outputFormatter))());
        $instance2->setMake($bodyContent["selectedMake"])->setModel($bodyContent["selectedModel"]);
        $instance2->setOutputFormatter(new ($this->getOutputFormatterFullName($outputFormatter))());

        return response()->json([
            'status' => 'success',
            'instance1_description' => $instance1->describe(),
            'instance2_description' => $instance2->describe(),
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
        $this->designPatternsService->designPattern->setTargetClass(Vehicle::class);

        // set user selected Vehicle make and model and set output formatter according to selected deisgn pattern category
        $instance = $this->designPatternsService->designPattern->getTargetClassInstance(null)
        ->setMake($bodyContent["selectedMake"])->setModel($bodyContent["selectedModel"]);

        $outputFormatter = ucfirst($bodyContent["category"]) . "OutputFormatter";
        $instance->setOutputFormatter(new ($this->getOutputFormatterFullName($outputFormatter))());

        return response()->json([
            'status' => 'success',
            'instance1_description' => $instance->describe(),
            'outputFormatter' => nl2br(htmlspecialchars($instance->outputFormatter->output(), ENT_QUOTES))
        ]);
    }

    /**
     * Method handles ajax call '/structural' for structural category of design patterns (Decorator pattern)
     * when a user submits a Vehcile form
     *
     * @param Request $req request object
     * @return json containing created instances of target class as per design pattern logic
     */
    public function structural(Request $req)
    {
        $bodyContent = $req->toArray();

        if ($bodyContent["pattern"] === 'decorator') {
            $origInstance = $this->getTargetClassInstance("factory", $bodyContent["selectedMake"], $bodyContent["selectedModel"], $bodyContent["category"], Vehicle::class, null);

            $decoratedInstance = $this->getTargetClassInstance($bodyContent["pattern"], $bodyContent["selectedMake"], $bodyContent["selectedModel"], $bodyContent["category"], VehicleDecorated::class, $origInstance);
        }

        return response()->json([
            'status' => 'success',
            'instance1_description' => $decoratedInstance->describe(),
            'outputFormatter' => nl2br(htmlspecialchars($decoratedInstance->outputFormatter->output(), ENT_QUOTES))
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
        if (!empty($this->outputFormatters[$formatterName])) {
            return $this->outputFormatters[$formatterName];
        }

        throw new InvalidArgumentException("Unsupported output formatter {$formatterName}");
    }

    /**
     * Helper method to retrieve target class (vehicle) instance
     *
     * @param string $pattern
     * @param string $make
     * @param string $model
     * @param string $category
     * @param string $targetClassName
     * @param mixed $targetClassConstructorArg
     * @return \App\Contracts\TargetClassContract
     */
    private function getTargetClassInstance(string $pattern, string $make, string $model, string $category, string $targetClassName, $targetClassConstructorArg): TargetClassContract
    {
        // set selected design pattern and vehicle as target class
        $this->designPatternsService->setDesignPattern(ucfirst($pattern));
        $this->designPatternsService->designPattern->setTargetClass($targetClassName);

        // set user selected Vehicle make and model and set output formatter according to selected deisgn pattern category
        $instance = call_user_func([$this->designPatternsService->designPattern, 'getTargetClassInstance'], $targetClassConstructorArg);
        $instance->setMake($make)->setModel($model);

        $outputFormatter = ucfirst($category) . "OutputFormatter";
        $instance->setOutputFormatter(new ($this->getOutputFormatterFullName($outputFormatter))());

        return $instance;
    }
}
