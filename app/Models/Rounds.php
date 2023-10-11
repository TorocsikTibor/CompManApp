<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rounds extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "rounds";

    public function competition(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Competitions::class);
    }
}
