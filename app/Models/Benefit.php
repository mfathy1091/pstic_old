<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;
    
    protected $guarded=[];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }
    public function record()
    {
        return $this->belongsTo(Record::class, 'record_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
