<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        // Crear token
        $token = $user->createToken('soundsync')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'message' => 'Usuario registrado con éxito'
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'No estás registrado'], 401);
        }

        // Crear token
        $token = $user->createToken('soundsync')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'message' => 'Inicio de sesión exitoso'
        ];

        return response()->json($response, 200);
    }
}