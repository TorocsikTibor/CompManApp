<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "competitions";

    public function competitionRound(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Round::class);
    }

}
