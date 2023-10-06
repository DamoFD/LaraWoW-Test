<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    public $incrememting = false;

    protected $fillable = [
        'id',
        'character_link',
        'protected_character_link',
        'name',
        'level',
        'realm_id',
        'playable_class_id',
        'playable_race_id',
        'gender_id',
        'faction_id',
        'account_id',
    ];

    public function getClass(): string
    {
        return match($this->playable_class_id) {
            1 => 'Warrior',
            2 => 'Paladin',
            3 => 'Hunter',
            4 => 'Rogue',
            5 => 'Priest',
            6 => 'Death Knight',
            7 => 'Shaman',
            8 => 'Mage',
            9 => 'Warlock',
            10 => 'Monk',
            11 => 'Druid',
            default => 'Demonhunter'
        };
    }

    public function getRace(): string
    {
        return match($this->playable_race_id) {
            1 => 'Human',
            2 => 'Orc',
            3 => 'Dwarf',
            4 => 'Night Elf',
            5 => 'Undead',
            6 => 'Tauren',
            7 => 'Gnome',
            8 => 'Troll',
            9 => 'Goblin',
            10 => 'Blood Elf',
            11 => 'Draenei',
            22 => 'Worgen',
            24 => 'Neutral Pandaren',
            25 => 'Alliance Pandaren',
            default => 'Horde Pandaren',
        };
    }

    public function getGender(): string
    {
        return $this->gender_id ? 'Female' : 'Male';
    }

    public function getFaction(): string
    {
        return $this->faction_id ? 'Horde' : 'Alliance';
    }
}
