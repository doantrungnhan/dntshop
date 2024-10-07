<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'productID' ;
    protected $fillable = [
        'product_code',
        'product_name',
        'description',
        'slug',
        'price',
        'discount',
        'views',
        'featured',
        'category_id',
    ];

    public function image(){
        return $this->hasMany(Product_image::class,'product_id','productID');
    }

        // public function variant(){
        //     return $this->hasMany(Product_variant::class,'product_id','productID');
        // }



    
}
