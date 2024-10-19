<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('active', true)->get();
        return response()->json(new PlanResource($plans), 200);
    }

    public function show(Plan $plan)
    {
        return response()->json(new PlanResource($plan), 200);
    }
}
