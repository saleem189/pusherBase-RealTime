<?php

namespace App\Providers;

use App\Helper\Student;
use Illuminate\Support\ServiceProvider;

class StudentFacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('student', function(){
            return new Student();   
         }); 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // app()->bind('student', function(){
        //     return new Student();   
        //  }); 
    }
}
