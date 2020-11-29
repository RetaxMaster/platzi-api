<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_product_belongs_to_a_category() {

        $category = Category::factory()->create();
        $product = Product::factory()->create(["category_id" => $category->id]);

        $this->assertInstanceOf(Category::class, $product->category);

    }
}
