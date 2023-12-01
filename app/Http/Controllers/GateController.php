<?php

namespace App\Http\Controllers;

use App\Http\Requests\GateRequest;

class GateController extends Controller
{
    public function store(GateRequest $request)
    {
        dd($request->all());
    }
}
