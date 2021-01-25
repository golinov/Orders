<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->service->all();

        return response()
            ->json(['data' => ProductResource::collection($data)], 200);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()
            ->json(['data' => ProductResource::make($product)], 200);
    }
}
