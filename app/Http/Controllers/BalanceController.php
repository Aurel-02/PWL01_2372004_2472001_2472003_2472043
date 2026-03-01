<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index()
    {
        return view('user.balance.index', [
            'user' => auth()->user()
        ]);
    }

    public function topup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000'
        ]);

        $user = auth()->user();
        $user->balance += $request->amount;
        $user->save();

        return back()->with('success', 'Saldo berhasil ditambahkan sebesar Rp ' . number_format($request->amount, 0, ',', '.'));
    }
}
