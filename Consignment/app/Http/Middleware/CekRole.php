<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(Cookie::has('userNowT')){
            $user = substr($request->cookie('userNowT'),0,5);
            if($user == $role){//$role di-isi dengan [CekRoke:(isian untuk $role)]
                return $next($request);
            }else{
                return redirect()->back()->with('message','Not Authorized');
            }
        }else{
            return redirect('/login')->with('message','Login dulu' );
        }


    }
}
