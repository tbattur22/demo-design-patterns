<?php

namespace App\Http\Controllers;

use App\Services\TargetClass\TargetClassService;
use Illuminate\Http\Request;

class TargetClassController extends Controller
{
    /**
     * stores target class service instance
     *
     * @var TargetClassService
     */
    protected $targetClassService;

    /**
     * Constructor injects Target Class Service instance
     *
     * @param TargetClassService $service
     */
    public function __construct(TargetClassService $service)
    {
        $this->targetClassService = $service;
    }

    /**
     * Method instantiates target class instance
     *
     * @param Request $req request object
     * @return json containing output of describe method of target class instance
     */
    public function create(Request $req)
    {
        $content = $req->toArray();
        $instance = $this->targetClassService->create($content["selectedMake"], $content["selectedModel"]);

        return response()->json([
            'status' => 'success',
            'message' => $instance->describe()
        ]);

    }
}
