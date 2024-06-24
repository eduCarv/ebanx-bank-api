<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function balance(Request $request)
    {
        $conta = Account::find($request->account_id);

        if (!$conta) {
            return response()->json(['message' => '0'], 404);
        }
        return response()->json(['message' => $conta->balance], 200);
    }

    public function event(Request $request)
    {
    }
}
