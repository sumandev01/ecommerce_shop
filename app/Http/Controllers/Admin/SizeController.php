<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::latest('id')->get();
        return view('admin.size.index', compact('sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required|string|max:255|unique:sizes,name',
        ]);

        Size::create([
            'name' => $request->size,
        ]);

        return to_route('size.index')->with('success', 'Size created successfully.');
    }

    public function edit(Size $size)
    {
        return view('admin.size.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'size' => 'required|string|max:255|unique:sizes,name,' . $size->id,
        ]);

        $size->update([
            'name' => $request->size,
        ]);

        return to_route('size.index')->with('success', 'Size updated successfully.');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return to_route('size.index')->with('success', 'Size deleted successfully.');
    }
}
