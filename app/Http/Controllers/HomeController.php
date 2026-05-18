<?php

namespace App\Http\Controllers;

use App\Models\ImageMenu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $items = ImageMenu::latest()->get();
    return view('pages.home', compact('items'));
}
}
