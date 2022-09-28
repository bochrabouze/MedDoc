<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Test extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        
        'image',
       
    ];
    public $timestamps = false;
   
}