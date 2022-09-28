<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
   
    protected $fillable = [
       
        'firstname',
        'name',
        'address',
        'phone',
        'dateofbirth',
        'bloodgroup',
        'weigh',
        'height',
        'allergy',
        'chronicdisease',
    ];
   
}
