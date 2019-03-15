<?php

namespace App\Http\Middleware;

use Closure;

class ProviderAuth
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
            return redirect('/');
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
