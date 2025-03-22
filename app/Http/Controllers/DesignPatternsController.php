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

        // if (in_array($pattern, array_keys($this->designPatternsService->getDesignPatterns()))) {
        //     $method = "handleDesignPattern" . ucfirst($pattern);
        //     return $this->$method();
        // }

        // throw new InvalidArgumentException("Unexcepted design pattern!");
    }

    // protected function handleDesignPatternSingleton()
    // {
    //     $instance = Singleton::getInstance();
    //     $instance->setTargetClass("Vehcile");
    //     return view('main', [
    //         'patterns' => $this->designPatternsService->getDesignPatterns(),
    //         'patternObj' => $instance
    //     ]);
    // }

    // protected function handleDesignPatternFactory()
    // {
    //     $instance = VehicleFactory::create('Toyota', 'Prius');
    //     return view('main', [
    //         'patterns' => $this->designPatternsService->getDesignPatterns(),
    //         'patternObj' => $instance,
    //         'form' => 'vehicle',
    //         'makeModels' => $this->targetClassService->getMakeModels()
    //     ]);
    // }

    public function create(Request $req)
    {
        $bodyContent = $req->toArray();
        $this->designPatternsService->setDesignPattern(ucfirst($bodyContent["pattern"]));
        $this->designPatternsService->designPattern->setTargetClass("Vehicle");

        $firstCall = $this->designPatternsService->designPattern->getTargetClassInstance()
        ->setMake($bodyContent["selectedMake"])->setModel($bodyContent["selectedModel"])
        ->describe();

        $secondCall = $this->designPatternsService->designPattern->getTargetClassInstance()
        ->setMake($bodyContent["selectedMake"])->setModel($bodyContent["selectedModel"])
        ->describe();

        return response()->json([
            'status' => 'success',
            'message' => $firstCall . " ===== " . $secondCall
        ]);
    }
}
