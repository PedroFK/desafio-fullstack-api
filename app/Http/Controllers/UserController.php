<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->load('activePlan');
        return response()->json(new UserResource($user), 200);
    }
}
