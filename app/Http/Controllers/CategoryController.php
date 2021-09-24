<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        return view('categories.index', [
            "categories" => $category
        ]);
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect('admins/categories');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function destroy(int $id){

        $categories=Category::findOrFail($id);

        $categories->delete();

        return back();
    }
}

