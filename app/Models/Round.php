<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Round extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "rounds";

    public function competitors(): BelongsToMany
    {
        return $this->belongsToMany(Competitor::class)->using( CompetitorRound::class);
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }
}
