<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GedaanKeuzedeel extends Model
{
    use HasFactory;

    protected $table = 'gedane_keuzedelen';

    protected $fillable = [
        'user_id',
        'keuzedeelcode',
        'naam',
        'cijfer',
        'status',
        'datum_afgerond'
    ];

    protected $dates = [
        'datum_afgerond'
    ];

    // Relatie met user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
