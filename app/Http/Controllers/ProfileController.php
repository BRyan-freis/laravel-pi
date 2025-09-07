<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        return view('perfil', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('perfil-edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Usuario $user */
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuarios')->ignore($user->id)],
            'telefone' => ['nullable', 'string', 'max:20'],
            'cidade' => ['nullable', 'string', 'max:100'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Atualiza os dados
        $user->fill($request->only(['name', 'email', 'telefone', 'cidade']));

        // Atualiza a senha APENAS se uma nova foi digitada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Faz o upload da imagem de perfil APENAS se uma nova foi enviada
        if ($request->hasFile('profile_image')) {
            // Deleta a imagem antiga se existir
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $path;
        }
        
        $user->save();

        return redirect()->route('perfil.show')->with('success', 'Perfil atualizado com sucesso!');
    }
}
