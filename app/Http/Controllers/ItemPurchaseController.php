<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemPurchaseController extends Controller
{
    public function store(Request $request, $id)
    {
        \Auth::user()->purchase($id);
        return view('users.purchases');
    }

    public function destroy($id)
    {
        \Auth::user()->unpurchase($id);
        return redirect()->back();
    }
}
