<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dentist extends Model
{
    protected $primaryKey = 'dentist_id';

    protected $fillable = [
        'user_id',
        'dentist_name',
        'specialization',
        'contact_information',
    ];

    /**
     * The login account of this dentist.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'dentist_id', 'dentist_id');
    }

    public function treatmentRecords(): HasMany
    {
        return $this->hasMany(TreatmentRecord::class, 'dentist_id', 'dentist_id');
    }
}
