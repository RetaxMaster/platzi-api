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

}
