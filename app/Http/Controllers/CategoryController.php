<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('category')->get();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
        ]);

        $categoryId = DB::table('category')->insertGetId([
            'category' => $request->category,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $category = DB::table('category')->where('id_category', $categoryId)->first();
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = DB::table('category')->where('id_category', $id)->first();
        if ($category) {
            return response()->json($category);
        } else {
            return response()->json(['message' => 'Category not found.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required|string',
        ]);

        $category = DB::table('category')->where('id_category', $id)->first();
        if ($category) {
            DB::table('category')->where('id_category', $id)->update([
                'category' => $request->category,
                'updated_at' => now(),
            ]);
            $updatedCategory = DB::table('category')->where('id_category', $id)->first();
            return response()->json($updatedCategory);
        } else {
            return response()->json(['message' => 'Category not found.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = DB::table('category')->where('id_category', $id)->first();
        if ($category) {
            DB::table('category')->where('id_category', $id)->delete();
            return response()->json(['message' => 'Category deleted successfully.']);
        } else {
            return response()->json(['message' => 'Category not found.'], 404);
        }
    }
}
