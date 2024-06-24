<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class GeneralApiController extends Controller
{
    
    public function reset()
    {
        Account::truncate();
        return response('OK', 200);
    }
}
