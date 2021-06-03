<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FoodService;
use App\Services\UserService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use PHPUnit\Exception;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    protected $foodService;

    public function __construct(FoodService $foodService, UserService $userService, CategoryService $categoryService)
    {
        $this->foodService = $foodService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = $this->foodService->getFoodWithCategoryShop();

        return view('admin.pages.food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        $shops = $this->userService->getAll();
        return view('admin.pages.food.createOrUpdate', compact('categories', 'shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('images');
        $path = Storage::disk('public')->put('foods', $file);

        $data = [
            'name' => $request->input('name'),
            'images' => url("/storage/" . $path),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'shop_id' => $request->input('shop_id'),
            'category_id' => $request->input('category_id')
        ];

        $this->foodService->store($data);

        return redirect()->route('food.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = $this->foodService->show($id, []);

        $categories = $this->categoryService->getAll();
        $shops = $this->userService->getUsersByRole('shop');

        return view('admin.pages.food.createOrUpdate', compact('food', 'shops', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $food_old = $this->foodService->show($id, []);

        if ($request->has('images')) {
            $oldImage = str_replace('/storage', '', $food_old->images);
            if (Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            $file = $request->file('images');
            $path = Storage::disk('public')->put('foods', $file);
            $food_data['images'] = url("/storage/" . $path);
        } else {
            $food_data['images'] = $food_old->images;
        }

        if ($request->has('name')) {
            $food_data['name'] = $request->name;
        }

        if ($request->has('price')) {
            $food_data['price'] = $request->price;
        }

        if ($request->has('description')) {
            $food_data['description'] = $request->description;
        }

        if ($request->has('shop_id')) {
            $food_data['shop_id'] = $request->shop_id;
        }

        if ($request->has('category_id')) {
            $food_data['category_id'] = $request->category_id;
        }

        $this->foodService->update($food_data, $id);

        return redirect()->back()->with('edit', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->foodService->delete($id);

        return response()->json(true);
    }
}
