<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitorRound extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "competitor_round";
    public $timestamps = false;

    public function competitor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Competitors::class);
    }

    public function competitionRound(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rounds::class);
    }

}
