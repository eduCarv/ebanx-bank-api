<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function balance(Request $request)
    {
        $account_id = $request->query('account_id');
        $account = Account::find($account_id);

        if (!$account) {
            return response('0', 404);
        }
        return response()->json($account->balance, 200);
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
                    return response()->json(['destination' => ['id' => $request->destination, 'balance' => $request->amount]], 201);
                } else {
                    $account->balance += $request->amount;
                    $account->save();
                    return response()->json(['destination' => ['id' => $request->destination, 'balance' => $account->balance]], 201);
                }
                break;
            case 'withdraw':
                $account = Account::find($request->origin);

                if (!$account) {
                    return response('0', 404);
                } else {
                    $account->balance -= $request->amount;
                    $account->save();
                    return response()->json(['origin' => ['id' => $request->origin, 'balance' => $account->balance]], 201);
                }
                break;
            case 'transfer':
                /*
                 	"type": "transfer",
	                "origin": "100",
	                "amount": 15,
	                "destination": "300"
                 */
                $originAccount = Account::find($request->origin);

                if (!$originAccount) {
                    return response('0', 404);
                } else {

                    //here should certify that the account have the amount requested but i will not implement by now.
                    $originAccount->balance -= $request->amount;
                    $originAccount->save();

                    $destinationAccount = Account::find($request->destination);

                    //Here i will create a new account for destination if doesn't exist
                    if (!$destinationAccount) {
                        Account::create([
                            'id' => $request->destination,
                            'balance' => 0
                        ]);
                        $destinationAccount = Account::find($request->destination);
                    }

                    $destinationAccount->balance += $request->amount;
                    $destinationAccount->save();

                    return response()->json([
                        'origin' => ['id' => (string) $originAccount->id, 'balance' => $originAccount->balance],
                        'destination' => ['id' => (string) $destinationAccount->id, 'balance' => $destinationAccount->balance]
                    ], 201);
                }

                break;

            default:
                return response()->json(['message' => 'Unknow event type'], 422);
                break;
        }
    }
}
