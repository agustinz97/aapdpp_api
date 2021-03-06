<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserStatusRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::with('role')->get(), 200);
    }

    public function update(User $user, UpdateUserRequest $request)
    {

        $validated = $request->validated();

        $user->update($validated);
        $user->load('role');
        $user->load('avatar');

        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json('', 204);
    }

    public function updateSubscriptionStatus(User $user, UpdateUserStatusRequest $request)
    {
        $validated = $request->validated();
        $user->active = $validated['active'];
        $user->update();
        $user->load('role');
        $user->load('avatar');

        return response()->json($user, 200);
    }
}
