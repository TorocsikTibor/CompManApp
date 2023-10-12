<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "competitors";

    public function competitionRound()
    {
        return $this->belongsToMany(Round::class)->using(CompetitorRound::class);
    }
}
