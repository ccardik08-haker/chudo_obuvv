<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'subcategory', 'size']);

        if ($request->filled('cat_id')) {
            $query->where('cat_id', $request->input('cat_id'));
        }

        if ($request->filled('subcat_id')) {
            $query->where('subcat_id', $request->input('subcat_id'));
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $sort = $request->input('sort', 'name_asc');

        $query->when($sort === 'price_asc', fn ($q) => $q->orderBy('price'))
              ->when($sort === 'price_desc', fn ($q) => $q->orderByDesc('price'))
              ->when($sort === 'name_asc', fn ($q) => $q->orderBy('name'))
              ->when($sort === 'name_desc', fn ($q) => $q->orderByDesc('name'));

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::orderBy('name')->get();
        $subcategories = $request->filled('cat_id')
            ? Subcategory::where('cat_id', $request->input('cat_id'))->orderBy('name')->get()
            : Subcategory::orderBy('name')->get();

        return view('products.index', compact('products', 'categories', 'subcategories', 'sort'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'subcategory', 'size']);

        $related = Product::where('subcat_id', $product->subcat_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}