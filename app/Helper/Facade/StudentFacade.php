<?php
namespace App\Helper\Facade;

use Illuminate\Support\Facades\Facade;

class StudentFacade extends Facade{
    
    protected static function getFacadeAccessor(){
        return 'student';
    }
    
}