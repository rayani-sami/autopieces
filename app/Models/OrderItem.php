<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderItem extends Model {
    protected $fillable = ['order_id','product_id','product_name','product_reference','quantity','unit_price','total_price'];
    protected $casts = ['unit_price'=>'decimal:3','total_price'=>'decimal:3'];
    public function order() { return $this->belongsTo(Order::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
