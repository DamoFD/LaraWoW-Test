<?php

namespace App\Types;

class User
{
    // Subject claim
    public string $sub;

    // User id
    public int $id;

    // User battletag
    public string $battletag;

    // User's Access Token
    public ?AccessToken $access_token;

    // User constructor
    public function __construct(object $data)
    {
        $this->sub = $data->sub;
        $this->id = $data->id;
        $this->battletag = $data->battletag;
        $this->access_token = null;

        return $this;
    }

    // Set User's Access Token
    public function setAccessToken(AccessToken $access_token): self
    {
        $this->access_token = $access_token;

        return $this;
    }

    // Get User's Access Token
    public function getAccessToken(): ?AccessToken
    {
        return $this->access_token;
    }

    // Convert User to array
    public function toArray(): array
    {
        return [
            'sub' => $this->sub,
            'id' => $this->id,
            'battletag' => $this->battletag,
            'access_token' => $this->access_token,
        ];
    }
}
