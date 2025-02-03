<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Log;

class AuthController extends Controller
{
      //login
      public function login(Request $request)
      {
           //validate dengan Auth::attempt
        if (Auth::attempt($request->only('email', 'password'))) {
          //jika berhasil buat token
          $user = User::where('email', $request->email)->first();
          //token lama dihapus
          $user->tokens()->delete();
          //abilities array
          $abilities =  $user->getAllPermissions()->pluck('name')->toArray();
          //from abilities array fliter only element that contains : and return it
          $abilities = array_filter($abilities, function ($ability) {
              return strpos($ability, ':') !== false;
          });
          $abilities = array_map(function ($ability) {
              return explode('_', $ability)[0];
          }, $abilities);
          //token baru di create
          $token = $user->createToken('token', $abilities)->plainTextToken;
          
          return new LoginResource([
              'token' => $token,
              'user' => $user
          ]);
      } else {
          //jika gagal kirim response error
          return response()->json([
              'message' => 'Invalid Credentials'
          ], 401);
      }
      }
  
    //logout
      public function logout(Request $request)
      {
          //hapus semua tuken by user
          $request->user()->tokens()->delete();
          //response no content
          return response()->noContent();
      }
}
