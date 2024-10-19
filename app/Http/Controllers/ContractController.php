<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $userId)
    {
        $contracts = Contract::where('user_id', $userId)->get();
        return response()->json(new ContractResource($contracts), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'start_date' => 'required|date',
        ]);

        Contract::where('user_id', $request->user_id)
            ->where('active', true)
            ->update(['active' => false, 'end_date' => now()]);

        $contract = Contract::create([
            'user_id' => $request->user_id,
            'plan_id' => $request->plan_id,
            'active' => true,
            'start_date' => $request->start_date,
        ]);

        return response()->json(new ContractResource($contract), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $contract->update(['active' => false, 'end_date' => now()]);

        $newContract = Contract::create([
            'user_id' => $contract->user_id,
            'plan_id' => $request->plan_id,
            'active' => true,
            'start_date' => now(),
        ]);

        return response()->json(new ContractResource($newContract), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
