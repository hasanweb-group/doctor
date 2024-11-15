<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSpecialization extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the specific specializations associated with this general specialization.
     */
    public function specificSpecializations()
    {
        return $this->hasMany(SpecificSpecialization::class);
    }
}

