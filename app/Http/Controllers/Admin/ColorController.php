<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::latest('id')->get();
        return view('admin.color.index', compact('colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:colors,name',
            'hex_code' => 'required|unique:colors,hex_code',
        ]);

        $Color = Color::create([
            'name' => $request->name,
            'hex_code' => $request->hex_code,
        ]);

        if ($Color) {
            return to_route('color.index')->with('success', 'Color created successfully.');
        } else {
            return to_route('color.index')->with('error', 'Failed to create Color.');
        }
    }

    public function edit(Color $color)
    {
        return view('admin.color.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        // dd($request->all(), $color->toArray());
        $message = [
            'name.required' => 'The color name is required.',
            'name.unique' => 'The color name has been already taken.',
            // 'hex_code.required' => 'The color code is required.',
            'hex_code.unique' => 'The color has been already taken.',
        ];

        $request->validate([
            'name' => 'required|unique:colors,name,' . $color->id,
            'hex_code' => 'required|unique:colors,hex_code,' . $color->id,
        ], $message);

        $updated = $color->update([
            'name' => $request->name,
            'hex_code' => $request->hex_code,
        ]);

        if ($updated) {
            return to_route('color.index')->with('success', 'Color updated successfully.');
        } else {
            return to_route('color.index')->with('error', 'Failed to update Color.');
        }
    }

    public function destroy(Color $color)
    {
        $deleted = $color->delete();

        if ($deleted) {
            return to_route('color.index')->with('success', 'Color deleted successfully.');
        } else {
            return to_route('color.index')->with('error', 'Failed to delete Color.');
        }
    }
}