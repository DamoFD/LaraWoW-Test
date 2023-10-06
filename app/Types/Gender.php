<?php

namespace App\Types;

class Gender
{
    // Gender Type
    public string $type;

    // Gender Name
    public string $name;

    // Gender constructor
    public function __construct(object $data)
    {
        $this->type = $data->type;
        $this->name = $data->name;

        return $this;
    }
}
