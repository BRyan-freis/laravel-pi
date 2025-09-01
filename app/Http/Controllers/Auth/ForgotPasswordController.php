<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Mostra o formulário para o usuário digitar o e-mail
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Valida o e-mail e envia o link de redefinição
    public function sendResetLinkEmail(Request $request)
    {
        // 1. Validação do campo de e-mail
        $request->validate(['email' => 'required|email|exists:usuarios']);

        // 2. Tenta enviar o e-mail com o link
        $status = Password::sendResetLink($request->only('email'));

        // 3. Verifica o resultado e redireciona o usuário
        return $status == Password::RESET_LINK_SENTx
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
}