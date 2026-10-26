<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TreatmentRecord extends Model
{
    protected $primaryKey = 'record_id';

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'treatment_type',
        'treatment_details',
        'treatment_date',
    ];

    protected function casts(): array
    {
        return [
            'treatment_date' => 'date',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function dentist(): BelongsTo
    {
        return $this->belongsTo(Dentist::class, 'dentist_id', 'dentist_id');
    }
}
