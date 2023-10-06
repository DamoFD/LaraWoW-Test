<?php

namespace App\Types;

class PlayableClass
{
    // Key URL
    public string $key;

    // Class Name
    public string $name;

    // Class id
    public int $id;

    // Class constructor
    public function __construct(object $data)
    {
        $this->key = $data->key->href;
        $this->name = $data->name;
        $this->id = $data->id;

        return $this;
    }
}
