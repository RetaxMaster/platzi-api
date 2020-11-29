<?php

namespace App\Http\Controllers;

use App\Console\Commands\SendEmailVerificationReminderCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NewsletterController extends Controller {

    public function send() {

        Artisan::call(SendEmailVerificationReminderCommand::class);

        return response()->json([
            "data" => "Todo ok"
        ]);
        
    }

}
