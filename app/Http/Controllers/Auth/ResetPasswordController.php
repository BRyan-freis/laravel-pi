<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    // Mostra o formulário para criar a nova senha
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Valida e atualiza a senha no banco
    public function reset(Request $request)
    {
        // 1. Validação dos campos
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:usuarios',
            'password' => 'required|confirmed|min:8',
        ]);

        // 2. Tenta redefinir a senha do usuário
        $status = Password::reset($request->all(), function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();
        });

        // 3. Redireciona com base no resultado
        return $status == Password::PASSWORD_RESET
                    ? redirect('/login')->with('status', __($status)) // Supondo que você tenha uma rota /login
                    : back()->withErrors(['email' => __($status)]);
    }
}