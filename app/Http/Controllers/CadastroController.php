<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{
    public function mostrarCadastro()
    {
        return view('paginas.cadastro');
    }

    public function cadastrar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'email_confirm' => 'required|email|same:email',
            'senha' => 'required|string|min:6',
            'senha_confirm' => 'required|same:senha',
        ], [
            'email_confirm.same' => 'Os e-mails não são iguais!',
            'senha_confirm.same' => 'As senhas não são iguais!',
            'senha.min' => 'A senha precisa ter pelo menos 6 caracteres.',
        ]);

        $existe = DB::table('usuario')
            ->where('email', $request->email)
            ->exists();

        if ($existe) {
            return back()
                ->withErrors(['email' => 'Este e-mail já está cadastrado.'])
                ->withInput($request->only('nome', 'email', 'email_confirm'));
        }

        DB::table('usuario')->insert([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect('/login')
            ->with('sucesso', 'Cadastro realizado! Agora faça login.');
    }
}
