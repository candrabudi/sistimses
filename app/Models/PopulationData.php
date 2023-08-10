<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationData extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'name',
        'gender',
        'phone_number',
        'address',
        'district',
        'sub_district',
        'person_responsible',
        'information',
        'photo_id'
    ];
}
