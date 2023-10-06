<?php

namespace App\Types;

class Faction
{
    // Faction Type
    public string $type;

    // Faction Name
    public string $name;

    // Faction ID
    public int $id;

    // Faction constructor
    public function __construct(object $data)
    {
        $this->type = $data->type;
        $this->name = $data->name;
        $this->id = $data->type === 'HORDE';

        return $this;
    }
}
