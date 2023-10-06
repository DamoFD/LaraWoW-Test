<?php

namespace App\Types;

class Mount
{
    // Mount Name
    public string $name;

    // Mount id
    public int $id;

    // Mount constructor
    public function __construct(object $data)
    {
        $this->name = $data->name;
        $this->id = $data->id;

        return $this;
    }
}
