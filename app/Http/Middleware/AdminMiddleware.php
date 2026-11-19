<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('usuario_id')) {
            return redirect()->route('login');
        }

        if (session('usuario_tipo') !== 'admin') {
            abort(403, 'Acesso permitido somente para administradores.');
        }

        return $next($request);
    }
}