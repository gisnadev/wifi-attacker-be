<?php

namespace App\Http\Controllers;
use App\Notifications\EmailNotification;
use App\Models\User;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Notification;

use NotificationChannels\Telegram\TelegramUpdates;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function mail()
    {

        $invoice = User::first();
        $updates = TelegramUpdates::create()
    // (Optional). Get's the latest update. NOTE: All previous updates will be forgotten using this method.
    // ->latest()
    
    // (Optional). Limit to 2 updates (By default, updates starting with the earliest unconfirmed update are returned).
//    ->limit(2)
    
    // (Optional). Add more params to the request.
    ->options([
        'timeout' => 0,
    ])
    ->get();
        dd($updates);
            Notification::route('telegram', '1635711844')
            ->notify(new TelegramNotification($invoice));
       /*$dopler = [
            'greeting' => 'Hi',
            'body' => 'This is the project assigned to you.',
            'thanks' => 'Thank you this is from codeanddeploy.com',
            'actionText' => 'View Project',
            'actionURL' => url('/'),
            'id' => 57
        ];
  
        Notification::send($user, new EmailNotification($dopler));
        dd($dopler);*/
    }
    public function clearCache()
    {
        \Artisan::call('cache:clear');

        return view('clear-cache');
    }
}
