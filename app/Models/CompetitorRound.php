<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompetitorRound extends Pivot
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "competitor_round";
    public $timestamps = false;

    public function competitors(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Competitor::class);
    }

    public function competitionRound(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

}
