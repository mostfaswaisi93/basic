<?php

namespace App\Listeners;

use App\Events\Logined;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LastLoginListener
{
    public function __construct()
    {
        //
    }

    public function handle(Logined $event)
    {
        $user = Auth::user();
        $user->last_login_at = Carbon::now();
        $user->save();
    }
}
