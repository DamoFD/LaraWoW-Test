<?php

namespace App\Types;

use App\Types\Realm;
use App\Types\PlayableClass;
use App\Types\PlayableRace;
use App\Types\Gender;
use App\Types\Faction;

class Character
{
    // Character Link
    public string $character_link;

    // Protected Character Link
    public string $protected_character_link;

    // Character Name
    public string $name;

    // Character id
    public int $id;

    // Realm Object
    public Realm $realm;

    // Playable Class Object
    public PlayableClass $playable_class;

    // Playable Race Object
    public PlayableRace $playable_race;

    // Character Gender Object
    public Gender $gender;

    // Character Faction Object
    public Faction $faction;

    // Character Level
    public int $level;

    // Character constructor
    public function __construct(object $data)
    {
        $this->character_link = $data->character->href;
        $this->protected_character_link = $data->protected_character->href;
        $this->name = $data->name;
        $this->id = $data->id;
        $this->realm = new Realm($data->realm);
        $this->playable_class = new PlayableClass($data->playable_class);
        $this->playable_race = new PlayableRace($data->playable_race);
        $this->gender = new Gender($data->gender);
        $this->faction = new Faction($data->faction);
        $this->level = $data->level;

        return $this;
    }
}
