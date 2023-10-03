<?php

namespace App\Types;

class AccessToken
{
    // The access token
    public string $access_token;

    // The type of access token
    public string $token_type;

    // Time in seconds when token expires
    public int $expires_in;

    // Carbon instance when token expires
    public \Carbon\Carbon $expires_at;

    // Scopes the token has access to
    public string $scope;

    // Access token constructor
    public function __construct(object $data)
    {
        $this->access_token = $data->access_token;
        $this->token_type = $data->token_type;
        $this->expires_in = $data->expires_in;
        $this->expires_at = \Carbon\Carbon::now()->addSeconds($data->expires_in);
        $this->scope = $data->scope;

        return $this;
    }
}
