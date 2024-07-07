<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return response()->json(['products' => $products]);
    }

    public function create()
    {
        // Not necessary for API backend
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $product = new Product($request->all());

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('images', 'public');
        }

        $product->save();

        return response()->json(['message' => 'Product created successfully.', 'product' => $product]);
    }

    public function show($id)
{
    $product = Product::find($id);

    if ($product===null) {
        return response()->json(['error' => 'Product not found.'], 404);
    }

    return response()->json(['product' => $product]);
}

    public function edit($id)
    {
        // Not necessary for API backend
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->name = $validated['name'];
        $product->category = $validated['category'];
        $product->price = $validated['price'];
        $product->quantity = $validated['quantity'];
        $product->location = $validated['location'];
        $product->description = $validated['description'];
        $product->save();

        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }

    public function editDescription(Product $product)
    {
        // Not necessary for API backend
    }

    public function updateDescription(Request $request, Product $product)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $product->description = $request->description;
        $product->save();

        return response()->json(['message' => 'Description updated successfully', 'product' => $product]);
    }
    public function toggleTrending(Product $product)
    {
        $product->trending = !$product->trending;
        $product->save();

        return response()->json(['message' => 'Product trending status updated.', 'product' => $product]);
    }
}
