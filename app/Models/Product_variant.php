<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    use HasFactory;
    protected $primaryKey = 'variantID' ;
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'quantity',
    ];

     public function size()
    {
        return $this->belongsTo(Product_size::class, 'size_id', 'sizeID');
    }

    public function color()
    {
        return $this->belongsTo(Product_color::class, 'color_id', 'colorID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'productID');
    }
}
