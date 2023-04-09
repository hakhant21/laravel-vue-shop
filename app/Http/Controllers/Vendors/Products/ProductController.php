<?php

namespace App\Http\Controllers\Vendors\Products;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\Products\CreateRequest;
use App\Http\Requests\Vendors\Products\UpdateRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{

    protected $colors = [];
    protected $sizes = [];
    public function __construct()
    {
        $this->colors = ['White','Black', 'Gray', 'Dark', 'Red'];

        $this->sizes = ['S', 'M', 'L', 'XL', '2XL'];
    }
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
        return Inertia::render('Vendors/Products/Create', [
            'colors' => $this->colors,
            'sizes' => $this->sizes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        if($request->file('image')) {
            $imageUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        $product = Product::create([
            'vendor_id' => auth()->user()->userVendor->vendor_id,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $imageUrl,
            'color' => $request->color,
            'size' => $request->size,
        ]);

        return to_route('vendors:products:index')->with('toast', 'Product created successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Vendors/Products/Show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Vendors/Products/Edit', [
            'product' => $product,
            'colors' => $this->colors,
            'sizes' => $this->sizes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        if($request->file('image')) {
            $imageUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        $product->update([
            'vendor_id' => auth()->user()->userVendor->vendor_id,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $imageUrl,
            'color' => $request->color,
            'size' => $request->size,
        ]);

        return to_route('vendors:products:index')->with('toast', 'Product updated successfully...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('vendors:products:index')->with('toast', 'Product deleted successfully...');
    }
}
