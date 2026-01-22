<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inschrijving;

class Keuzedeel extends Model
{
    use HasFactory;

    protected $table = 'keuzedelen';

    protected $fillable = [
        'code',
        'keuzedeelcode',
        'opleiding',
        'naam', 
        'beschrijving',
        'periode',
        'max_studenten',
        'min_studenten',
        'is_actief',
        'inschrijving_open',
        'inschrijving_start',
        'inschrijving_eind'
    ];

    protected $casts = [
        'is_actief' => 'boolean',
        'inschrijving_open' => 'boolean',
        'max_studenten' => 'integer',
        'min_studenten' => 'integer',
        'inschrijving_start' => 'datetime',
        'inschrijving_eind' => 'datetime'
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
    
    public function getInschrijfPeriodeOpenAttribute()
    {
        if (!$this->inschrijving_open) {
            return false;
        }
        
        $now = now();
        
        if ($this->inschrijving_start && $now < $this->inschrijving_start) {
            return false;
        }
        
        if ($this->inschrijving_eind && $now > $this->inschrijving_eind) {
            return false;
        }
        
        return true;
    }
    
    public function heeftMinimumBereikt()
    {
        return $this->aantal_inschrijvingen >= $this->min_studenten;
    }
}
