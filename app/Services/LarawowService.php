<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Exception;
use App\Types\AccessToken;
use App\Types\User as UserType;
use App\Models\User;

class LarawowService
{
    /**
    * OAuth Token URL
    */
    protected string $tokenURL = "https://oauth.battle.net/token";

    /**
    * Base API URL
    */
    protected string $baseApi = "https://oauth.battle.net/";

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
    public function getAccessTokenFromCode(string $code): AccessToken
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

        return new AccessToken(json_decode($response->body()));
    }

    /**
    * returns the user's account
    */
    public function getCurrentAccount(AccessToken $accessToken): UserType
    {
        $response = Http::withToken($accessToken->access_token)->get($this->baseApi . 'userinfo');

        $response->throw();

        return new UserType(json_decode($response->body()));
    }

    /**
    * Create or update the user in the db
    */
    public function updateOrCreateUser(UserType $user): User
    {
        if (!$user->getAccessToken()) {
            throw new Exception('User access token is missing.');
        }

        return User::updateOrCreate(
            [
                'id' => $user->id,
            ],
            $user->toArray(),
        );
    }
}
