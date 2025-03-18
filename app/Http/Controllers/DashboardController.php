<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Category;
use App\Models\PromoCode;

class DashboardController extends Controller
{
    public function index()
    {
        // Test if this method is being called

        $productsCount = Product::count();
        $ingredientsCount = Ingredient::count();
        $categoriesCount = Category::count();
        $promoCodesCount = PromoCode::count();

        return view('gestion.dashboard', [
            'productsCount' => $productsCount,
            'ingredientsCount' => $ingredientsCount,
            'categoriesCount' => $categoriesCount,
            'promoCodesCount' => $promoCodesCount,
        ]);
    }
}