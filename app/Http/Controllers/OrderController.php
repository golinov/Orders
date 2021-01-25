<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Throwable;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $service;

    /**
     * OrderController constructor.
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $this->service->checkIP($request->ip());
        $order = $request->validated();
        $data = $this->service->store($order);

        return response()
            ->json(['data' => OrderResource::make($data)], 201);
    }
}
