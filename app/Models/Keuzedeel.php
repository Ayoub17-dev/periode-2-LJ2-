<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inschrijving;

class Keuzedeel extends Model
{
    use HasFactory;

    protected $fillable = [
        'naam',
        'beschrijving',
        'max_studenten',
        'is_actief',
        'periode',
        'min_studenten',
        'code'
    ];

    protected $casts = [
        'is_actief' => 'boolean',
        'max_studenten' => 'integer',
        'min_studenten' => 'integer'
    ];

    public function inschrijvingen()
    {
        return $this->hasMany(Inschrijving::class);
    }

    public function getAantalInschrijvingenAttribute()
    {
        return $this->inschrijvingen()->where('status', 'accepted')->count();
    }

    public function getIsVolAttribute()
    {
        return $this->aantal_inschrijvingen >= $this->max_studenten;
    }

    public function getKanStartenAttribute()
    {
        return $this->aantal_inschrijvingen >= $this->min_studenten;
    }
}
