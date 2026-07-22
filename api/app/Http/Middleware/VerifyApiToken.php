<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-KEY');

        if (! $token || ! hash_equals(config('sictec.api_key'), (string) $token)) { //sctec.api_key, configurado en el archivo confic/sictec.php
            return response()->json(['error' => 'No autorizado'], 401);
        }

        return $next($request);
    }
}