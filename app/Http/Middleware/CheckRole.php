<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user() ) {
            return redirect()->route('show.login');
        }
        if ($request->user()->role !== $role) {
            return $this->redirectToUserDashboard($request->user());
        }
        return $next($request);
    }
    private function redirectToUserDashboard($user): Response
    {
        return match($user->role) {
            'admin' => redirect()->route('admin.index'),
            'teacher' => redirect()->route('teacher.index'),
            'lab_assistant' => redirect()->route('lab_assistant.index'),
            default => redirect()->route('show.login'),
        };
    }
}
