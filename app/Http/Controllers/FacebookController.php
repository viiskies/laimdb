<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Socialite;
use App\User;

class FacebookController extends Controller
{
    public function redirect () {
        return Socialite::driver('facebook')->redirect();
    }    
    
    public function callback () {
        $user = Socialite::driver('facebook')->user();
        $isUser = User::where('fb_id', $user['id'])->exists();
        if(!$isUser) {
            $thisUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => 'user',
                'password' => '',
                'fb_id' => $user['id']
            ]);
            Auth::login($thisUser);
        } else {
            $thisUser = User::where('fb_id', $user['id'])->first();
            Auth::login($thisUser);
        }
        return redirect()->route('movies.all');
    }
}
