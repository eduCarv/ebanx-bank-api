<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function balance(Request $request)
    {
        $account = Account::find($request->account_id);

        if (!$account) {
            return response()->json(['message' => '0'], 404);
        }
        return response()->json(['message' => $account->balance], 200);
    }

    /**
     * Types of event:
     * deposit: creates an accout with amount or deposit into an existing account
     * withdraw: subtracts amount from balance
     * transfer: transfer amount from origin to destination
     */
    public function event(Request $request)
    {
        switch ($request->type) {
            case 'deposit':
                
                $account = Account::find($request->destination);

                if (!$account) {
                    Account::create([
                        'id' => $request->destination,
                        'balance' => $request->amount
                    ]);
                    return response()->json(['201' => ['destination' => ['id' => $request->destination, 'balance' => $request->amount]]], 201);
                } else {
                    $account->balance += $request->amount;
                    $account->save();
                    return response()->json(['200' => ['destination' => ['id' => $request->destination, 'balance' => $account->balance]]], 200);
                }
                break;
            case 'withdraw':
                # code...
                break;
            case 'transfer':
                # code...
                break;

            default:
                return response()->json(['message' => 'Unknow event type'], 422);
                break;
        }
    }
}
