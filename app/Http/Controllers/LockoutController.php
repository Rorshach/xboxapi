<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class LockoutController extends Controller
{
    public function show() {
        $lastSent = \Auth::user()->profile()->first()->last_sent;
        $oneDaySecs = 86400;
        $secondsLeft = $lastSent + $oneDaySecs - time();
        $hoursLeft = ceil($secondsLeft/60/60);
        return view('lockout',['timeLeft' => $hoursLeft]);
    }
}
