<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

//test api
Route::post('/test', function () {
    return response()->json(['message' => 'Test route works']);
});
//test api again
use Illuminate\Support\Facades\Auth;

Route::post('/login-test', function (Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    return response()->json([
        'message' => 'Invalid Credentials',
    ], 401);
});
