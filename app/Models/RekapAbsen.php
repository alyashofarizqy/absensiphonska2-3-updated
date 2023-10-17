<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekapAbsen extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'checkin_id',
        'checkout_id',
        'user_id',
        'tanggal',
        'shift',
        'catatan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date:Y-m-d',
    ];

    /**
     * Get the user that owns the RekapAbsen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the checkin that associated with the RekapAbsen
     *  
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkin(): BelongsTo
    {
        return $this->belongsTo(Absen::class, 'checkin_id');
    }

    /**
     * Get the checkout that associated with the RekapAbsen
     *  
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkout(): BelongsTo
    {
        return $this->belongsTo(Absen::class, 'checkout_id');
    }
}
