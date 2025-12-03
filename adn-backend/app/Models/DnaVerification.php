<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DnaVerification extends Model
{
    protected $fillable = ['dna', 'mutation'];

    protected $casts = [
        'mutation' => 'boolean',
        'dna' => 'array', // Para que se guarde como JSON
    ];
}
