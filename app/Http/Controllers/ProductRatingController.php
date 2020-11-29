<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\RatingResource;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductRatingController extends Controller {

    public function rate(Product $product, Request $request)
    {
        $this->validate($request, [
            'score' => 'required'
        ]);

        /** @var User $user */
        $user = $request->user();
        $user->rate($product, $request->get('score'));

        return new ProductResource($product);
    }

    public function unrate(Product $product, Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $user->unrate($product);

        return new ProductResource($product);
    }

    public function approve(Rating $rating) {

        Gate::authorize("admin", $rating);

        $rating->approve();
        $rating->save();

        return response()->json();
    }

    public function list(Request $request) {

        Gate::authorize("admin");

        $builder = Rating::query();

        if ($request->has("approved"))
            $builder->whereNotNull("approved_at");

        if ($request->has("notApproved"))
            $builder->whereNull("approved_at");

        return RatingResource::collection($builder->get());
        
    }

}