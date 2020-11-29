<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;

trait CanRate {

    public function ratings($model = null) {

        $modelClass = $model ? $model : $this->getMorphClass();

        $morphToMany = $this->morphToMany(
            $modelClass,
            "qualifier",
            "ratings",
            "qualifier_id",
            "rateable_id"
        );

        $morphToMany
            ->as("rating")
            ->withTimestamps()
            ->withPivot("score", "rateable_type")
            ->wherePivot("rateable_type", $modelClass)
            ->wherePivot("qualifier_type", $this->getMorphClass());

        return $morphToMany;

    }

    public function rate(Model $model, float $score) {
        
        if ($this->hasRated($model))
            return false;

        $this->ratings($model)->attach($model->getKey(), [
            "score" => $score,
            "rateable_type" => get_class($model)
        ]);

        return true;

    }

    public function hasRated(Model $model) {

        return !is_null($this->ratings($model->getMorphClass())->find($model->getKey()));
        
    }
    
}


?>