<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class, 'beneficiaries_emergencies', 'emergency_id', 'beneficiary_id');
    }
}
