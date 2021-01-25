<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use Tests\TestCase;

class OrdertTest extends TestCase
{
    public function getData()
    {
        $collection = collect(['product_id', 'quantity']);
        $products = Product::factory(2)
            ->create()
            ->pluck('id')
            ->map(function ($product) use ($collection) {
                return  $collection->combine([$product, random_int(1, 10)]);
            })
            ->toArray();
        $order = Order::factory()
            ->create()
            ->first()
            ->toArray();
        $order['products'] = $products;

        return $order;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store_order_block_ip_failure()
    {
        $data = $this->getData();
        $AU = ['REMOTE_ADDR' => '139.99.159.18'];
        $response = $this->withServerVariables($AU)
            ->postJson('api/order', $data, $this->defaultHeaders);
        $response
            ->assertStatus(451);
    }

    public function test_store_order_successfully()
    {
        $data = $this->getData();
        $response = $this->postJson('api/order', $data, $this->defaultHeaders);
        $response
            ->assertStatus(201);
    }

    public function test_store_order_validation_failure()
    {
        $response = $this->postJson('api/order', [], $this->defaultHeaders);
        $response
            ->assertStatus(422);
    }
}
