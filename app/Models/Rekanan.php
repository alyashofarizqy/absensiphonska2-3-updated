<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'telepon',
        'unit',
        'item',
        'pekerjaan',
        'no_permit',
        'rekanan',
        'open',
        'close',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'open' => 'timestamp:H:i:s',
        'close' => 'timestamp:H:i:s',
    ];
}
