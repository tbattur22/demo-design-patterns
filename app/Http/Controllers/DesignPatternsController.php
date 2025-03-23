<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DesignPatterns\DesignPatternService;
use App\Services\DesignPatterns\Singleton;
use App\Services\DesignPatterns\VehicleFactory;
use App\Services\TargetClass\TargetClassService;
use Illuminate\Http\Request;
use InvalidArgumentException;

class DesignPatternsController extends Controller
{
    protected $designPatternsService;
    protected $targetClassService;

    public function __construct(DesignPatternService $service, TargetClassService $targetClassService)
    {
        $this->designPatternsService = $service;
        $this->targetClassService = $targetClassService;
    }

    public function main()
    {
        return view('main', [
            'patterns' => $this->designPatternsService->getDesignPatterns(),
            'home' => true
        ]);
    }

    public function designPattern(string $pattern)
    {
        $this->designPatternsService->setDesignPattern(ucfirst($pattern));
        $this->designPatternsService->designPattern->setTargetClass("Vehicle");
        // return $this->designPatternsService->designPattern->describe();
        return view('main', [
            'patterns' => $this->designPatternsService->getDesignPatterns(),
            'patternObj' => $this->designPatternsService->designPattern,
            'targetClassInstance' => $this->designPatternsService->designPattern->getTargetClassInstance()
        ]);
    }

    public function create(Request $req)
    {
        $bodyContent = $req->toArray();
        $this->designPatternsService->setDesignPattern(ucfirst($bodyContent["pattern"]));
        $this->designPatternsService->designPattern->setTargetClass("Vehicle");

        $outputFormatter = ucfirst($bodyContent["category"]) . "OutputFormatter";

        $instance1 = $this->designPatternsService->designPattern->getTargetClassInstance();
        $instance2 = $this->designPatternsService->designPattern->getTargetClassInstance();

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

    public function behave(Request $req)
    {
        $bodyContent = $req->toArray();
        $this->designPatternsService->setDesignPattern(ucfirst($bodyContent["pattern"]));
        $this->designPatternsService->designPattern->setTargetClass("Vehicle");

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

    private function getOutputFormatterFullName($formatterName)
    {
        return "App\\Models\\Vehicles\\{$formatterName}";
    }
}
