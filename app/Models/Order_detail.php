<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $primaryKey = "order_detailID";
    public $timestamps = false;
    protected $fillable = [
        'variant_id',
        'order_id',
        'quantity',
        'price'
    ];

    public function product_variant(){
        return $this->belongsTo(Product_variant::class,'variant_id','variantID');
    }
}
