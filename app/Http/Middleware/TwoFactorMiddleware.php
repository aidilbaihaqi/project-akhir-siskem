<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $user = auth()->user();
    // Cek: User login, masih ada kode, dan session 2FA masih pending
    if (
        auth()->check() && 
        $user->two_factor_code && 
        session('two_factor_pending')
    ) {
        // Jika expired
        if ($user->two_factor_expires_at < now()) {
            $user->resetTwoFactorCode();
            session()->forget('two_factor_pending');
            auth()->logout();
            return redirect()->route('login')
                ->withStatus('Your verification code expired. Please re-login.');
        }
        // Jika buka selain verify
        if (!$request->is('verify*')) {
            return redirect()->route('verify.index');
        }
    }

    return $next($request);
}

}
