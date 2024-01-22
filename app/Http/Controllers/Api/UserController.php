<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')->only(['store']);
    }
    public function store(UserCreateRequest  $request)
    {
        $request->validated();
        $user = User::make([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);
        $user->api_token = Str::random(80);
        $user->save();

        return new UserResource($user);
    }
}
