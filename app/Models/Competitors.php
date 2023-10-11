<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitors extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "competitors";
}
