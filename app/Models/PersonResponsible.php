<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonResponsible extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'district',
        'sub_district',
        'address',
    ];
}
