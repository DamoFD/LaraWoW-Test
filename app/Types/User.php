<?php

namespace App\Types;

class User
{
    // Subject claim
    public string $sub;

    // User id
    public int $id;

    // User battletag
    public int $battletag;

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
}
