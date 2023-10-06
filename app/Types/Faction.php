<?php

namespace App\Types;

class Faction
{
    // Faction Type
    public string $type;

    // Faction Name
    public string $name;

    // Faction constructor
    public function __construct(object $data)
    {
        $this->type = $data->type;
        $this->name = $data->name;

        return $this;
    }
}
