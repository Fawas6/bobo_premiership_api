<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->validated()['email'])->first();

        if (!$user) {
            throw new BadRequestHttpException('User not found');
        }

        if (Auth::attempt($request->validated())) {
            $user = user();
            $user['bearer_token'] = $user->createToken('auth_token')->plainTextToken;
            return Response::api("Login successful", $user['bearer_token'],  code: 200);
        }

        return Response::api("Invalid credentials. Please try again.", code: 400);
    }
}
