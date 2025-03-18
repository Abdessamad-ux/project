<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::latest()->paginate(10);
        return view('gestion.promo_codes.index', compact('promoCodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|unique:promo_codes',
            'code' => 'required|unique:promo_codes'
        ]);

        PromoCode::create($request->all());
        return redirect()->back()->with('success', 'Code promo ajouté avec succès');
    }

}