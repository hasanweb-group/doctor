<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
    ];

    /**
     * Get the patient associated with the prescription.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor associated with the prescription.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function prescriptionInformation()
    {
        return $this->hasMany(PrescriptionInformation::class);
    }
}
