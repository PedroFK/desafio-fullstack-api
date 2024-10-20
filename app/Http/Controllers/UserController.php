<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user = User::with('activeContract')->first();
        return response()->json(new UserResource($user), 200);
    }
}
