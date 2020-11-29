<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_belongs_to_many_users()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Product $product */
        $product = Product::factory()->create();

        $user->rate($product, 5);

        // dd($user->ratings()->get());
        // dd($product->ratings()->get())

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->ratings(Product::class)->get());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $product->qualifiers(User::class)->get());
    }

    public function test_averageRating()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var User $user2 */
        $user2 = User::factory()->create();
        /** @var Product $product */
        $product = Product::factory()->create();

        $user->rate($product, 5);
        $user2->rate($product, 10);

        $this->assertEquals(7.5, $product->averageRating(User::class));
    }

    public function test_rating_model()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Product $product */
        $product = Product::factory()->create();

        $user->rate($product, 5);

        /** @var Rating $rating */
        $rating = Rating::first();

        $this->assertInstanceOf(Product::class, $rating->rateable);
        $this->assertInstanceOf(User::class, $rating->qualifier);
    }
}