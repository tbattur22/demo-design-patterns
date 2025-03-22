<?php

namespace App\Http\Controllers;

use App\Services\TargetClass\TargetClassService;
use Illuminate\Http\Request;

class TargetClassController extends Controller
{
    protected $targetClassService;

    public function __construct(TargetClassService $service)
    {
        $this->targetClassService = $service;
    }

    public function create(Request $req)
    {
        $content = $req->toArray();
        $instance = $this->targetClassService->create($content["selectedMake"], $content["selectedModel"]);
        // return view('debug', [
        //     'debug' => $bodyContent
        // ]);
        return response()->json([
            'status' => 'success',
            'message' => $instance->describe()
        ]);

    }
}
