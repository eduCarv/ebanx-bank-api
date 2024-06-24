<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralApiController extends Controller
{
    public function reset(){
        //Reseta o banco de dados 
        return  response(200);
    }
}
