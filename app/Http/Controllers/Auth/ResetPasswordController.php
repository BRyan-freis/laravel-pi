<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
     // Este método MOSTRA sua tela de redefinição, passando o token e o e-mail
    public function showResetForm(Request $request, $token = null)
    {
        // O Laravel vai procurar o arquivo em: resources/views/auth/passwords/reset.blade.php
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Este método PROCESSA a nova senha
    public function reset(Request $request)
    {
        // 1. Valida todos os dados recebidos
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:usuarios', // Troque para 'users' se for o padrão
            'password' => 'required|confirmed|min:8',
        ]);

        // 2. Usa a lógica do Laravel para resetar a senha
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($usuario, $password) {
                $usuario->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $usuario->save();
            }
        );

        // 3. Redireciona o usuário para o login com uma mensagem de sucesso ou devolve um erro
        return $status == Password::PASSWORD_RESET
                    ? redirect('/login')->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
