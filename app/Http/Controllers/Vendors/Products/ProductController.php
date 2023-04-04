<?php

namespace App\Http\Controllers\Vendors\Products;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->paginate(10)->withQueryString();

        return Inertia::render('Vendors/Products/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Vendors/Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->file('image')) {
            $imageUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        $product = Product::create([
            'vendor_id' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $imageUrl,
            'color' => $request->color,
            'size' => $request->size,
        ]);

        return to_route('vendors:products:index')->with('success', 'Product created successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Vendors/Products/Show', [
            'product' => $product
        ])
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Vendors/Products/Edit', [
            'product' => $product
        ])
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if($request->file('image')) {
            $imageUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        $product->update([
            'vendor_id' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $imageUrl,
            'color' => $request->color,
            'size' => $request->size,
        ]);

        return to_route('vendors:products:index')->with('success', 'Product updated successfully...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('vendors:products:index')->with('success', 'Product deleted successfully...');
    }
}
