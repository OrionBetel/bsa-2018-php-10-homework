<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Entity\Currency;
use Illuminate\Support\Facades\Gate;
use App\Jobs\SendRateChangedEmail;

class CurrencyController extends Controller
{
    public function updateRate(Request $request)
    {
        $currency = Currency::find($request->id);
        
        if (Gate::denies('update', $currency)) {
            return redirect('/');
        }

        $oldCurrencyRate = $currency->rate;

        $newCurrencyRate = $request->input('rate');

        $currency->rate = $newCurrencyRate;

        $currency->save();

        $users = User::where('is_admin', false)->get();

        foreach ($users as $user) {
            SendRateChangedEmail::dispatch($user, $currency, $oldCurrencyRate);
        }

        return response()->json($currency);
    }
}
