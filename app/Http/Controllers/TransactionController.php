<?php

namespace App\Http\Controllers;

use App\Models\DB\DBtransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    public function transfer(Request $request)
    {
        $request->validate([
            'bank' => ['required', 'string', 'max:255'],
            'accountName' => ['required', 'string', 'max:255'],
            'accountNumber' => ['required', 'regex:/^\d+$/', 'max:255'],
            'beneficiaryReference' => ['required', 'string', 'max:255'],
            'myReference' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'gt:0'],
        ]);
        DBtransactions::create([
            'user' => auth()->user()->id,
            'bank' => $request->input('bank'),
            'accountName' => $request->input('accountName'),
            'accountNumber' => $request->input('accountNumber'),
            'beneficiaryReference' => $request->input('beneficiaryReference'),
            'myReference' => $request->input('myReference'),
            'amount' => (double) $request->input('amount'),
        ]);
        return ['message' => 'Transfer completed'];
    }
    public function transactions()
    {

        $transactions = DBtransactions::where(['user' => auth()->user()->id])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($transaction) {
                $transaction->created_at_formatted = Carbon::parse($transaction->created_at)->format('d M Y H:i:s');
                return $transaction;
            });

        return $transactions;
    }
}
