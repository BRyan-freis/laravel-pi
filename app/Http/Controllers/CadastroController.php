<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreatesNewUsers; // Importa o Trait
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CadastroController extends Controller
{
    use CreatesNewUsers; // "Usa" o Trait dentro da classe

    public function create()
    {
        return view('cadastro');
    }

   // Em app/Http/Controllers/CadastroController.php

public function store(Request $request)
{
    // A linha dd($request->all()); foi removida daqui.

    try {
        // Tenta chamar o método do Trait para validar e criar o usuário
        $usuario = $this->createUser($request);

        // Se der certo, faz o login
        Auth::login($usuario);

        // E redireciona com sucesso
        return redirect()->route('perfil.show')->with('success', 'Cadastro realizado com sucesso!');

    } catch (\Exception $e) {
        // 👇 SE ALGO DER ERRADO, O CÓDIGO VAI PARAR AQUI E MOSTRAR O ERRO REAL 👇
        // dd($e->getMessage()); 

        // O código abaixo não será executado enquanto o dd() estiver ativo
        Log::error('Erro ao cadastrar usuário: ' . $e->getMessage());
        return back()->withInput()->withErrors(['cadastro' => 'Erro ao realizar cadastro. Por favor, tente novamente.']);
    }
}
}
