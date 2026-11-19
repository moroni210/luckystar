<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function mostrarLogin()
    {
        return view('paginas.login');
    }

    
public function entrar(Request $request)
{
    $request->validate([
        'usuario' => 'required|email',
        'password' => 'required|string',
    ]);

    $usuario = DB::table('usuario')
        ->where('email', $request->usuario)
        ->first();

    if (!$usuario || !Hash::check(
        $request->password,
        $usuario->senha
    )) {
        return back()->withErrors([
            'login' => 'E-mail ou senha incorretos!'
        ])->withInput();
    }

    session([
        'usuario_id' => $usuario->id,
        'usuario_nome' => $usuario->nome,
        'usuario_email' => $usuario->email,
        'usuario_tipo' => $usuario->tipo,
    ]);

    if ($usuario->tipo === 'admin') {
        return redirect('/')
            ->with('sucesso', 'Login realizado com sucesso!');
    }

    return redirect('/')
        ->with('sucesso', 'Login realizado com sucesso!');
}

}