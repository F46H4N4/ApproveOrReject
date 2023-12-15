<?php

namespace App\Http\Middleware;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                // dd($user->status);
                if ($user->status == 0) {
                    Auth::guard($guard)->logout(); // Logout user if status is 0
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('login')->with('error', 'Your account is not active.');
                }

                if ($guard == 'admin') {
                    return redirect(RouteServiceProvider::ADMIN_HOME);
                }

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
