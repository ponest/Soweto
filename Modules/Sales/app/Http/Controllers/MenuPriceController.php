<?php

namespace Modules\Sales\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Sales\Models\MenuPrice;

class MenuPriceController extends Controller
{
    public function index()
    {
        $params['items'] = MenuPrice::whereIsActive(true)->get();
        return view('sales::price.menu_price', $params);
    }
}
