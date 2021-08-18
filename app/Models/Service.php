<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function beneficiaries()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }
}
