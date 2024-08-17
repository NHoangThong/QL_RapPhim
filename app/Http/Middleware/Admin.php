<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
           
           
            if (Auth::user()->role == 0) {
              return $next($request);
            } else {
               return redirect('/admin/sign_in')->with('error', 'Bạn không có quyền truy cập.');
            }
        } else {
            
            return redirect('admin/sign_in')->with('error', 'Bạn không có quyền truy cập.');
        }
        // if (!empty(auth()->user())) {
          
        //     setPermissionsTeamId(session('team_id'));
        // }
        // else {
        //     return redirect('admin/sign_in');
        // }
        // return $next($request);
        
    }
}
