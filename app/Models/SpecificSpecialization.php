<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificSpecialization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'general_specialization_id'];

    /**
     * Get the general specialization that this specific specialization belongs to.
     */
    public function generalSpecialization()
    {
        return $this->belongsTo(GeneralSpecialization::class);
    }
}
