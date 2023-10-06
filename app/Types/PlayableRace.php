<?php

namespace App\Types;

class PlayableRace
{
    // Key URL
    public string $key;

    // Race Name
    public string $name;

    // Race id
    public int $id;

    // Race constructor
    public function __construct(object $data)
    {
        $this->key = $data->key->href;
        $this->name = $data->name;
        $this->id = $data->id;

        return $this;
    }
}
