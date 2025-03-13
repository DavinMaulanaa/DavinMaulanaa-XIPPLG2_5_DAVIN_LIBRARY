<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return respone()->json([
            'status' => 200,
            'message' => 'Categories retrived succesfully. ',
            'data' => $categories

        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:225']);

        $category = Category::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Category created succesfully.',
            'data' => null
        ], 404);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status'=> 200,
            'message' => 'Category retrived succesfully.',
            'data' => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
                'data' => null
            ], 404);
        }

        $request->validate(['name' => 'string|max:252']);
        $category->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Category update successfully.',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
                'data' => null
            ], 404);
        }

        $category->delete();    

        return response()->json([
            'status' => 200,
            'message' => 'Category delete successfully.',
            'data' => null
        ], 200);
    }
}
