<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        // Criação do usuário
        $user = UserModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }
}
