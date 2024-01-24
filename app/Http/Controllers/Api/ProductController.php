<?php

namespace App\Http\Controllers\Api;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGetListRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ProductGetListRequest $request)
    {
        $queryParams = $request->validated();
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($queryParams)]);
        $products = Product::filter($filter);

        return  ProductResource::collection($products->paginate(40)->withQueryString());
    }
}
