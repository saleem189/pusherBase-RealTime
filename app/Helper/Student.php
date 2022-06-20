<?php
namespace App\Helper;

class Student {
    
    public $first_name = "saleem";    
    public $last_name = "khan";



    
    public function showName(){
        return $this->first_name;
    } 

    public function fullName(){
        return ucfirst( $this->first_name." ". $this->last_name);
    }
    
}



