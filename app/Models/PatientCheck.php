<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCheck extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'check_in', 'check_out'];

    // Relationships

    /**
     * Get the patient that owns the check.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
