<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\ImageMenu;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $items = ImageMenu::latest()->get();
        
        $heroes = Hero::latest()->get();

        $products = Product::latest()->get();

        return view('pages.home', compact('items', 'heroes', 'products'));
    }
}
