<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!\Auth::check()) {
            return redirect('/admin/login');
        } else {
            // $isAdmin = \App\Models\User::select('*')
            //             ->where('id',\Auth::id())
            //             ->Where(function ($query) {
            //                 $query->where('role_id','1')
            //                       ->where('status','active');
            //                 })                      
            //             ->first();
            // if(!$isAdmin){
            //     return redirect('/admin/');
            // }
        }

        return $next($request);
    }
}
