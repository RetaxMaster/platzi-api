<?php

namespace App\Providers;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class RatingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {



    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   
        // Recibe el nombre de la vista y un callback
        view()->composer("home", function(View $view) {
            $view->with("rating", RatingResource::collection(Rating::all()));
        });
    }
}
