<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'action'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
