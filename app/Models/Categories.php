<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $primaryKey = 'categoryID' ;
    protected $fillable = [
        'category_name',
        'slug',
        'image',
        'description',
    ];

    public function products(){
        return $this->hasMany(Product::class,'category_id','categoryID');
    }
}
