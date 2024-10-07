<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_color extends Model
{
    use HasFactory;
    protected $primaryKey = 'colorID' ;
    public $timestamps = false;
    protected $fillable = [
        'color_name',
    ];
}
