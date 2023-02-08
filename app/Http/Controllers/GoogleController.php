<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Siswa;
use App\Models\Tb_google;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use PhpParser\Node\Stmt\Catch_;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->back();
        }

        $authUser = $this->findOrCreateUser($user, $provider);


        Auth()->login($authUser, true);


        return redirect()->intended('/');
    }

    public function findOrCreateUser($socialUser, $provider)
    {


            $user = Siswa::where('email', $socialUser->getEmail())->first();


            if (!$user) {
                $user = Siswa::create([
                    'nama'  => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => $socialUser->getEmail(),
                    'social_id' => $socialUser->getId(),
                    'social_type' => $provider,
                    'remember_token' => Str::random(10),
                ]);
            }

            return $user;
        }
    }


