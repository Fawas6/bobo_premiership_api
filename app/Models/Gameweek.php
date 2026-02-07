<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gameweek extends Model
{
    use HasFactory;

    protected $table = 'gameweeks';

    protected $guarded = [];
}
