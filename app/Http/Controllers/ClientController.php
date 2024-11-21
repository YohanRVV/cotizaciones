<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'address' => 'nullable|string|max:255',
        ]);

        $client = Client::create($request->only(['name', 'email', 'address']));

        return response()->json([
            'message' => 'Cliente creado con éxito.',
            'client' => $client,
        ], 201);
    }
}
