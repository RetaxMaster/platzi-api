<?php

namespace App\Exceptions;

use Exception;

class InvalidScore extends Exception {

    public function __construct($from, $to) {
        $this->from = $from;
        $this->to = $to;
    }

    public function render() {

        return response()->json([
            trans("rating.invalidScore", [
                "from" => $this->from,
                "to" => $this->to
            ])
        ]);
        
    }

}
