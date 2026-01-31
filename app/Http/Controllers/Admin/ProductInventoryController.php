<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductInventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    public function inventory(Product $product)
    {
        $inventories = ProductInventory::where('product_id', $product->id)->get();
        $products = Product::latest('id')->get();
        $sizes = Size::latest('id')->get();
        $colors = Color::latest('id')->get();
        return view('admin.product.inventory', compact('inventories', 'product', 'products', 'sizes', 'colors'));
    }

    public function store(Request $request, Product $product)
    {
        // Validate the request data
        $request->validate([
            'size_id' => 'required|exists:sizes,id',
            'color_id' => 'required|exists:colors,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $oldInventory = ProductInventory::where('product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->where('color_id', $request->color_id)
            ->first();

        if ($oldInventory) {
            // Update the existing inventory
            $oldInventory->update([
                'quantity' => $oldInventory->quantity + $request->quantity,
            ]);
            return to_route('product.inventory', $product->id)->with('success', 'Inventory updated successfully.');
        }

        // Store the inventory data
        ProductInventory::create([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'quantity' => $request->quantity,
        ]);

        // Update the product stock
        $totalStock = ProductInventory::where('product_id', $product->id)->sum('quantity');
        $product->update([
            'stock' => $totalStock,
        ]);

        return to_route('product.inventory', $product->id)->with('success', 'Inventory added successfully.');
    }

    public function update(Request $request, ProductInventory $inventory)
    {
        $request->validate([
            // 'product_id' => 'required|exists:products,id',
            // 'editSize' => 'required|exists:sizes,id',
            // 'editColor' => 'required|exists:colors,id',
            'editQuantity' => 'required|integer|min:0',
        ]);
        ProductInventory::where('id', $inventory->id)->update([
            // 'size_id' => $request->editSize,
            // 'color_id' => $request->editColor,
            'quantity' => $request->editQuantity,
        ]);

        // Update the product stock
        $totalStock = ProductInventory::where('product_id', $inventory->product_id)->sum('quantity');
        Product::where('id', $inventory->product_id)->update([
            'stock' => $totalStock,
        ]);
        
        return to_route('product.inventory', $inventory->product_id)->with('success', 'Quantity updated successfully.');
    }

    public function destroy(ProductInventory $inventory)
    {
        $productId = $inventory->product_id;
        $inventory->delete();

        $totalStock = ProductInventory::where('product_id', $productId)->sum('quantity');
        Product::where('id', $productId)->update([
            'stock' => $totalStock,
        ]);
        return to_route('product.inventory', $inventory->product_id)->with('success', 'Inventory deleted successfully.');
    }
}
