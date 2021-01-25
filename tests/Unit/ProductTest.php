<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_list_product()
    {
        $products = Product::factory(20)->create()->toArray();
        $response = $this->json('GET', 'api/product', [], $this->defaultHeaders);

        $response
            ->assertStatus(200)
            ->assertJson(['data' => $products]);
    }

    public function test_can_show_product()
    {
        $product = Product::factory()->create();
        $response = $this->json('GET', 'api/product/' . $product->id, [], $this->defaultHeaders);

        $response
            ->assertStatus(200)
            ->assertJson(['data' => $product->toArray()]);
    }
}
