<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
    protected $primaryKey = 'imageID' ;
    public $timestamps = false;
    protected $fillable = [
        'image_url',
        'product_id',
    ];
}
