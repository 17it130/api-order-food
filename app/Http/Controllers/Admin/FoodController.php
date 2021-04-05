<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FoodService;
use Illuminate\Http\Request;
use PHPUnit\Exception;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    protected $foodService;

    public function __construct(FoodService $foodService) {
        $this->foodService = $foodService;
    }

    public function getAll() {
        $foods = $this->foodService->getAll();

        return view('admin.pages.food.index', compact('foods'));
    }

    public function show($id) {
        $food = $this->foodService->show($id);
        $category = 1;

        return view('admin.pages.food.createOrUpdate', compact('food', 'category'));
    }

    public function update(Request $request) {
        $food_old = $this->foodService->show($request->id);

        if($request->has('images')) {
            $oldImage = str_replace('/storage', '', $food_old->images);
            if(Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            $file = $request->file('images');
            $path = Storage::disk('public')->put('foods',$file);
            $food_data['images'] = "/storage/".$path;
        }
        
        if($request->has('name')) {
            $food_data['name'] = $request->name;
        }
        if($request->has('price')) {
            $food_data['price'] = $request->price;
        }
        if($request->has('rating')) {
            $food_data['rating'] = $request->rating;
        } else {
            $food_data['rating'] = $food_old->rating;
        }
        if($request->has('shop_id')) {
            $food_data['shop_id'] = $request->shop_id;
        }

        $this->foodService->update($food_data, $request->id);

        return redirect()->back()->with('edit', true);
    }
}
