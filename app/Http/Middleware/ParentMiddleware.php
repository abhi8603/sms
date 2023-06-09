<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ParentMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if($this->auth->check()){
            if($this->auth->user()->user_role!='P'){
                $this->auth->logout();
                return redirect('/')->with([
                    'message'=>'Invalid Access',
                    'message_important'=>true
                ]);
            }

        }

        return $next($request);
    }
}
