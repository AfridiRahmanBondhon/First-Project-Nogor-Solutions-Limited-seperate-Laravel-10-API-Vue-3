<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='forms';
    protected $fillable=[
        'name',
        'email',
        'image',
        'gender',
        'skills'
    ];


    public function getImageAttribute($value = null){
        return url('storage/'.$value);
    }
}
