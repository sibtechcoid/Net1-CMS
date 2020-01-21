<?php

namespace App\Http\Controllers\Api;

use App\ApiModels\Plan;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{

    public function index()
    {
        $response['plans'] = Plan::all();
        $response['code'] = 200;
        return response()->json($response);
    }

    public function show(Plan $plan)
    {
        $response['plan'] = $plan;
        $response['code'] = 200;
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_name' => 'required|unique:plans'
        ]);
        
        try {
            $plan = new Plan;
            $plan->plan_name = $request->plan_name;
            $plan->save();
            $response['message'] = 'New plan added.';
            $response['code'] = 200;
        }
        catch(\Exception $e) {
            $custom_error = ValidationException::withMessages([
                'internal_server' => ['Failed to add new plan. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }
        return response()->json($response);
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'plan_name' => 'required|unique:plans'
        ]);
        try {
            $plan->plan_name = $request->plan_name;
            $plan->save();
            $response['message'] = 'Plan updated.';
            $response['code'] = 200;
        }
        catch(\Exception $e) {
            $custom_error = ValidationException::withMessages([
                'internal_server' => ['Failed to update plan. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }
        return response()->json($response);
    }
}
