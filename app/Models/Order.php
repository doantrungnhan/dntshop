<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'orderID';
    protected $fillable = [
        'order_code',
        'total_amount',
        'payment_method',
        'payment_status',
        'shipping_fee',
        'order_status',
        'user_id',
        'promotion_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','userID');
    }

    public function order_detail(){
        return $this->hasMany(Order_detail::class,'order_id','orderID');
    }

    public function promotion(){
        return $this->belongsTo(Promotion::class,'promotion_id','promotionID');
    }


    
}
