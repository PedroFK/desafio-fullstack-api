<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Payment;
use App\Models\Plan;
use App\Http\Resources\ContractResource;

class ContractService
{
    public function store($userId, $planId)
    {
        $oldContract = Contract::where('user_id', $userId)
            ->where('active', true)
            ->first();

        $plan = Plan::find($planId);
        if (!$plan) {
            return response()->json(['error' => 'Plano não encontrado'], 404);
        }

        if ($oldContract && $oldContract->plan_id == $planId) {
            return response()->json(['error' => 'Este plano já está em uso.'], 400);
        }

        $credit = 0;

        if ($oldContract) {
            $credit = $this->calculateCredit($oldContract);
            $oldContract->update(['active' => false, 'end_date' => now()]);
        }

        $contract = Contract::create([
            'user_id' => $userId,
            'plan_id' => $planId,
            'credit' => $credit > $plan->price ? abs($plan->price - $credit) : 0,
            'active' => true,
            'start_date' => now(),
        ]);

        if ($credit <= $plan->price) {
            $paymentAmount = $plan->price - $credit;

            Payment::create([
                'contract_id' => $contract->id,
                'amount' => $paymentAmount,
                'payment_date' => now(),
            ]);
        }

        return new ContractResource($contract);
    }

    private function calculateCredit($oldContract)
    {
        $oldPlan = Plan::find($oldContract->plan_id);
        $startDate = \Carbon\Carbon::parse($oldContract->start_date);
        $endDate = now();
        $renewalDate = (clone $startDate)->addMonth();
        $totalDaysInCycle = $renewalDate->diffInDays($startDate);
        $daysUsed = $endDate->diffInDays($startDate);
        $percentageNotUsed = ($totalDaysInCycle - $daysUsed) / $totalDaysInCycle;

        return ($percentageNotUsed <= 1) ? $oldPlan->price * $percentageNotUsed + $oldContract->credit : $oldContract->credit;
    }
}
