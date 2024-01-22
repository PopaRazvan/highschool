<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{

    protected $apiPath;

    public function __construct()
    {
        $this->apiPath = Config::get('highschool-api.highschool_api_path');
    }

    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $response = Http::post($this->apiPath . '/auth/login', $formFields);

        if ($response->successful()) {
            $responseData = $response->json();
            session(['access_token' => $responseData['access_token']]);
            return redirect('/home')->with('message', 'Login successfuly!');
        } else {
            return redirect('/login')->with('message',  $response->json()['message']);
        }
    }

    public function register(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
            'passwordConfirmation' => 'required|same:password',
        ]);

        $response = Http::post($this->apiPath . '/auth/register', ['email'=>$formFields['email'], 'password'=>$formFields['password']]);
        if ($response->successful()) {
            return redirect('/login')->with('message', 'Account created!');
        } else {
            return redirect('/register')->with('message',  $response->json()['message']);
        }
    }

    public function logout()
    {
        session(['access_token' => '']);
        return redirect('/');
    }
}
