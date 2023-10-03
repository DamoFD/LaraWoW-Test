<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LarawowService
{
    /**
    * OAuth Token URL
    */
    protected string $tokenURL = "https://oauth.battle.net/token";

    /**
     * The required data for the token request.
     */
    protected array $tokenData = [
        "client_id" => NULL,
        "client_secret" => NULL,
        "grant_type" => "authorization_code",
        "code" => NULL,
        "redirect_uri" => NULL,
    ];

    /**
     * LarawowService constructor.
     */
    public function __construct()
    {
        $this->tokenData['client_id'] = config('larawow.client_id');
        $this->tokenData['client_secret'] = config('larawow.client_secret');
        $this->tokenData['redirect_uri'] = config('larawow.redirect_uri');
    }

    /**
     * returns the access token using the returned code.
     */
    public function getAccessTokenFromCode(string $code)
    {
        $this->tokenData['code'] = $code;

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->tokenData['client_id'] . ':' . $this->tokenData['client_secret']),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post($this->tokenURL, [
            'grant_type' => 'authorization_code',
            'code' => $this->tokenData['code'],
            'redirect_uri' => $this->tokenData['redirect_uri'],
        ]);

        dd($response->body());

        return new AccessToken(json_decode($response->body()));
    }
}
