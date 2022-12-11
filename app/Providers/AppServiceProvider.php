<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Mode\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) 
        {

        

        
            if(DB::connection()->getDatabaseName())
            {
                if(!empty(Auth::user()->id)){
                    $user_id_log = Auth::user()->id;

                    $data["user_role_per"] = DB::table('users')
                    ->where('id',$user_id_log)
                    ->first();

                    $data["settingsinfo"] = DB::table('settings')
                    ->first();

                    $data["set_currency"] = DB::table('currency_setting')
        			->first();

                    View::share($data);
                } else {
                    
                    $data["settingsinfo"] = DB::table('settings')
                    ->first();

                    $data["set_currency"] = DB::table('currency_setting')
                    ->first();

                    View::share($data);
                }
            }
                
        
        });  
    }
}
