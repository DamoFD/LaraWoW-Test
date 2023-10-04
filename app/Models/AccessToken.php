<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use HasFactory;

    protected $table = 'wow_access_tokens';

    protected $fillable = [
        'access_token',
        'token_type',
        'expires_in',
        'expires_at',
        'user_id',
    ];
}
