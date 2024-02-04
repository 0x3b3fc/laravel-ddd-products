<?php

namespace App\API\Users\Controllers;

use App\API\Users\Resources\ProductResource;
use Illuminate\Http\Request;
use Domain\Users\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::all();

        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required',
            'details' => 'required'
        ]);

        $product = Product::create($validator);

        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    public function update(Request $request, Product $product)
    {

        $validator = $request->validate([
            'name' => 'required',
            'details' => 'required'
        ]);

        $product->name = $validator['name'];
        $product->details = $validator['details'];
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
