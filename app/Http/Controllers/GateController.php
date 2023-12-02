<?php

namespace App\Http\Controllers;

use App\Events\GateSucceed;
use App\Http\Requests\GateRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GateController extends Controller
{
    public function store(GateRequest $request): JsonResponse
    {
        GateSucceed::dispatch();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
