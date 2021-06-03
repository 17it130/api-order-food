<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::user()->role == 'admin') {
            $ordersCount = Order::all()->count();
            $sum = Order::all()->sum('totalPrice');
            $foodsCount = Food::all()->count();
            $reviewsCount = Review::all()->count();
        } else {
            $ordersCount = Order::join('order_details', 'orders.id', 'order_details.order_id')
                ->where('order_details.shop_id', Auth::user()->id)
                ->count();
            $sum = Order::join('order_details', 'orders.id', 'order_details.order_id')
                ->where('order_details.shop_id', Auth::user()->id)
                ->sum('orders.totalPrice');
            $foodsCount = Food::where('shop_id', Auth::user()->id)->count();
            $reviewsCount = Review::join('foods', 'reviews.food_id', '=', 'foods.id')
                ->where('foods.shop_id', Auth::user()->id)
                ->count();
        }
        return view('admin.pages.dashboard.index', compact('ordersCount', 'sum', 'foodsCount', 'reviewsCount'));
    }
}
