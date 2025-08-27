<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LaudoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (acessíveis por todos)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Rotas de Cadastro de Usuário
Route::get('/cadastro', [CadastroController::class, 'create'])->name('cadastro.create');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');

// Rotas de Cadastro de Médico
Route::get('/cadastromedico', [MedicoController::class, 'create'])->name('cadastromedico.create');
Route::post('/cadastromedico', [MedicoController::class, 'store'])->name('cadastromedico.store');

// Rotas de Autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas para recuperação de senha
Route::get('/recuperacao', fn() => view('recuperacao'))->name('recuperacao');
Route::get('/redefinicao', fn() => view('redefinicao'))->name('redefinicao');

// Rotas de páginas estáticas
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/termos-de-servico', 'termos-de-servico')->name('termos');
Route::view('/escolha', 'escolha')->name('escolha');
Route::view('/abordagem', 'abordagem')->name('abordagem');
Route::view('/agenda', 'agenda')->name('agenda');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (requerem autenticação)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Área principal do usuário
    Route::get('/area-user', function () {
        return view('area-user');
    })->name('area-user');

    // Rotas de Perfil
    Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('perfil.update');

    // Rotas de Salas
    Route::get('/salas', [SalaController::class, 'index'])->name('salas.index');
    Route::get('/criar-salas', [SalaController::class, 'create'])->name('salas.create');
    Route::post('/salas', [SalaController::class, 'store'])->name('salas.store');

    // Rotas de Laudos
    Route::get('/cadastrolaudo', fn() => view('cadastrolaudo'))->name('cadastrolaudo');
    Route::post('/laudo', [LaudoController::class, 'store'])->name('laudo.store');
});

// Grupo específico para médicos autenticados
Route::middleware(['auth', 'auth.medicos'])->group(function () {
    Route::get('/perfil-medico', function () {
        return view('perfil-medico');
    })->name('perfil.medico');
    
    // Outras rotas que SÓ médicos podem acessar iriam aqui...
});
