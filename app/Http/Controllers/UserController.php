<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json(new UserResource($users), 200);
    }

    public function show(User $user)
    {
        $user->load('activePlan');
        return response()->json(new UserResource($user), 201);
    }
}
