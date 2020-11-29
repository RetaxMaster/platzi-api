<?php

namespace App\Utils;

trait CanBeRated {

    public function qualifiers($model = null) {

        $modelClass = $model ? (new $model)->getMorphClass() : $this->getMorphClass();

        return $this->morphToMany($modelClass, 'rateable', 'ratings', 'rateable_id', 'qualifier_id')
            ->withPivot('qualifier_type', 'score')
            ->wherePivot('qualifier_type', $modelClass)
            ->wherePivot('rateable_type', $this->getMorphClass());

    }

    public function averageRating(string $model = null) {

        return $this->qualifiers($model)->avg("score") ?: 0.0;
        
    }
    
}

?>