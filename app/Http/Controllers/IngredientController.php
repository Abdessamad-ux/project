<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::paginate(10);
        return view('gestion.ingredients.index', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_fr' => 'required|string|max:255',
            'nom_en' => 'required|string|max:255',
            'nom_nl' => 'required|string|max:255',
        ]);

        Ingredient::create($request->all());
        return redirect()->route('ingredients.index')->with('success', 'Ingrédient ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_fr' => 'required|string|max:255',
            'nom_en' => 'required|string|max:255',
            'nom_nl' => 'required|string|max:255',
        ]);

        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->all());
        return redirect()->route('ingredients.index')->with('success', 'Ingrédient modifié avec succès.');
    }

    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', 'Ingrédient supprimé avec succès.');
    }
}