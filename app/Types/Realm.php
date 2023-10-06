<?php

namespace App\Types;

class Realm
{
    // Key URL
    public string $key;

    // Realm Name
    public string $name;

    // Realm id
    public int $id;

    // Realm Slug
    public string $slug;

    // Realm constructor
    public function __construct(object $data)
    {
        $this->key = $data->key->href;
        $this->name = $data->name;
        $this->id = $data->id;
        $this->slug = $data->slug;

        return $this;
    }
}
