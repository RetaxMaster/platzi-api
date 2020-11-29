<?php

namespace App\Models;

use App\Utils\CanBeRated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    
    use HasFactory, CanBeRated;

    protected $guarded = [];

    public function category() {

        return $this->belongsTo(Category::class);
        
    }

    public function createdBy() {

        return $this->belongsTo(User::class);
        
    }

    // Aquí podemos llamar a los eventos de Eloquent
    protected static function booted() {
        
        // Antes de crear el objeto añadirá una imágen por defecto
        static::creating(function(Product $product) {

            $faker = \Faker\Factory::create();
            $product->image_url = $faker->imageUrl();
            $product->createdBy()->associate(auth()->user());
            
        });

    }

}
