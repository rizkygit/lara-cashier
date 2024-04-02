<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = DB::table('menu')->get();
        return response()->json($menus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        $menuId = DB::table('menu')->insertGetId([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $menu = DB::table('menu')->where('id_menu', $menuId)->first();
        return response()->json($menu, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = DB::table('menu')->where('id_menu', $id)->first();
        if ($menu) {
            return response()->json($menu);
        } else {
            return response()->json(['message' => 'Menu not found.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string',
            'description' => 'string',
            'price' => 'numeric',
            'category' => 'string',
        ]);

        $menu = DB::table('menu')->where('id_menu', $id)->first();
        if ($menu) {
            DB::table('menu')->where('id_menu', $id)->update([
                'name' => $request->name ?? $menu->name,
                'description' => $request->description ?? $menu->description,
                'price' => $request->price ?? $menu->price,
                'category' => $request->category ?? $menu->category,
                'updated_at' => now(),
            ]);
            $updatedMenu = DB::table('menu')->where('id_menu', $id)->first();
            return response()->json($updatedMenu);
        } else {
            return response()->json(['message' => 'Menu not found.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = DB::table('menu')->where('id_menu', $id)->first();
        if ($menu) {
            DB::table('menu')->where('id_menu', $id)->delete();
            return response()->json(['message' => 'Menu deleted successfully.']);
        } else {
            return response()->json(['message' => 'Menu not found.'], 404);
        }
    }
}
