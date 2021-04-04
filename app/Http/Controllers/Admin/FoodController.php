<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $foods = Food::all();

        return view('admin.pages.food.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)
            ->where('type', '<>', 4)
            ->get();

        return view('admin.pages.category.createOrUpdate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category_data = $this->handleFormRequest($request);
        Category::create($category_data);

        return redirect()->route('danh-muc.index')->with('add', true);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Food::findOrFail($id);

        return view('admin.pages.food.createOrUpdate', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category_data = $this->handleFormRequest($request);
        $category->update($category_data);

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
        Category::findOrFail($id)->delete();

        return response()->json(true);
    }

    public function handleFormRequest(Request  $request, $category_data = []) {
        if ($request->input('parent_id')) {
            $category_data['parent_id'] = $request->input('parent_id');
        }
        if ($request->input('type')) {
            $category_data['type'] = $request->input('type');
        }
        if ($request->input('category')) {
            $category_data['vi'] = [
                'category' => $request->input('category'),
                'slug' => Str::slug($request->input('category'))
            ];
        }
        if ($request->input('category_en')) {
            $category_data['en'] = [
                'category' => $request->input('category_en'),
                'slug' => Str::slug($request->input('category_en'))
            ];
        }

        return $category_data;
    }
}
