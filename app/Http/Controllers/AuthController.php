<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:Utilisateur,email',
                'password' => 'required|string|min:6|confirmed',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], 400);
            }
    
            $user = Utilisateur::create([
                'email' => $request->email,
                'mdp' => $request->password,
                'tentative' => 0,
                'role' => 'user',
                'is_active' => 1,
            ]);
    
            return response()->json(['message' => 'Inscription réussie !'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur interne',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}
