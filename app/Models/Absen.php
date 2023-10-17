<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Absen extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo',
        'latitude',
        'longitude',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:10',
        'longitude' => 'decimal:11',
    ];

    /**
     * Get the rekapAbsen that owns the Absen
     *  
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rekapAbsen(): HasOne
    {
        return $this->hasOne(RekapAbsen::class);
    }

    /**
     * Override the photo attribute to return the full URL
     */
    public function getPhotoAttribute($value): string
    {
        return Storage::url($value);
    }
}
