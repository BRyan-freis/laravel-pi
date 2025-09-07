<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
     // Este método simplesmente MOSTRA a sua tela
    public function showLinkRequestForm()
    {
        // O Laravel vai procurar o arquivo em: resources/views/auth/passwords/email.blade.php
        return view('auth.passwords.email');
    }

    // Este método PROCESSA o formulário
    public function sendResetLinkEmail(Request $request)
    {
        // 1. Valida o e-mail. Esta é a regra que verifica se o e-mail está no banco!
        $request->validate(['email' => 'required|email|exists:usuarios']); // Troque para 'users' se necessário

        // 2. Usa a lógica interna do Laravel para enviar o link
        $status = Password::sendResetLink($request->only('email'));

        // 3. Responde para a view com uma mensagem de sucesso ou erro
        return $status == Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
}
