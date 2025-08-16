<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    use ApiResponder;
    public function redirect(Request $request)
    {
        $scramble = $request->query('scramble', false); // default
        if ($scramble) {
            # code...
            $redirectPath = 'scr';
        } else {
            $redirectPath = $request->query('redirect', '/b/dashboard'); // default

        }
        session(['redirect_after_login' => $redirectPath]);
        return Socialite::driver('google')->redirect();
    }
    public function authenticate(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $volunteer = User::firstOrCreate(
            ['email' => $user->email],
            ['name' => $user->name, 'avatar' => $user->avatar, 'role' => 'member', 'phone' => uniqid()]
        );

        $volunteer->update([
            'name' => $user->name,
            'avatar' => $user->avatar,
        ]);
        $token = Auth::claims($volunteer->toArray())->login($volunteer);
        $redirectPath = session()->pull('redirect_after_login', '/b/dashboard');
        if ($redirectPath == "scr") {
            return $token;
        }
        return response()
            ->redirectTo(env('FRONTEND_URL') . '/auth/callback?next=' . $redirectPath . '&token=' . $token);
    }

    public function me()
    {
        return $this->success(new UserResource(Auth::user()));
    }
}
