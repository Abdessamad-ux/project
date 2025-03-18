<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('gestion.produit.index', compact('products'));
    }

    public function create()
    {
        return view('gestion.produit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'emporter' => 'required|numeric',
            'livraison' => 'required|numeric',
            'ingredients' => 'required|string',
            'titre' => 'required|string|max:255',
        ]);

        Product::create($request->all());
        return redirect()->route('gestion.produit.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('gestion.produit.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'emporter' => 'required|numeric',
            'livraison' => 'required|numeric',
            'ingredients' => 'required|string',
            'titre' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('gestion.produit.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('gestion.produit.index')->with('success', 'Produit supprimé avec succès.');
    }
}