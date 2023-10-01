<?php

namespace App\Http\Controllers\api\v1;

use update;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\productResource;
use App\Http\Requests\storeProductRequest;
use App\Http\Requests\updateProductRequest;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;

class productController extends Controller
{

    //show all products method
    public function index()
    {
        return productResource::collection(Product::all());
    }

//create a product record method
    public function store(storeProductRequest $request)
    {
        $Product = Product::create($request->validated());
        return new productResource ($Product);
    }


    //return one record

    public function show(product $product)
    {
        return productResource::make($product);
    }


    //Update a record
    public function update(updateProductRequest $request, product $product)

    {
        $product->update($request->validated());
        return productResource::make($product);
    }


 public function destroy(product $product)
 {
    $product->delete();

    return response()->noContent();
 }



}