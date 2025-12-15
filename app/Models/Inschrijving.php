<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Keuzedeel;

class Inschrijving extends Model
{
    use HasFactory;

    protected $table = 'inschrijvingen';

    protected $fillable = [
        'user_id',
        'keuzedeel_id',
        'periode',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keuzedeel()
    {
        return $this->belongsTo(Keuzedeel::class);
    }
}
