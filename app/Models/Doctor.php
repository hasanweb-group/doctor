<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'general_specialization_id',
        'specific_specialization_id',
    ];



    public function getFullNameAttribute()
    {
        return $this->employee->full_name ?? null;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function generalSpecialization()
    {
        return $this->belongsTo(GeneralSpecialization::class);
    }

    public function specificSpecialization()
    {
        return $this->belongsTo(SpecificSpecialization::class);
    }
}
