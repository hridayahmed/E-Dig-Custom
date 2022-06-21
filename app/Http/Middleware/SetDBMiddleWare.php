<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use PDO;
use Illuminate\Support\Facades\DB;

class SetDBMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
{
    // $dbName="test";
    if (Auth::check())
    {
        //$dbName="ediagnosis".Auth::id();
        $dbName="inventory2";
        //dd(Auth::id());
        //  DB::disconnect('mysql');//here connection name, I used mysql for example
        Config::set('database.connections.mysql2.database', $dbName); //new database name, you want to connect to.
        return $next($request);

    }

    else
    {
        abort('404');
    }


}

}
