<?php

namespace App\Types;

use App\Types\Character;

class WowAccount
{
    // Account id
    public int $id;

    // List of Characters
    public array $characters;

    // Account constructor
    public function __construct(object $data)
    {
        $this->id = $data->id;

        foreach ($data->characters as $character) {
            $this->characters[] = new Character($character);
        }

        return $this;
    }
}
