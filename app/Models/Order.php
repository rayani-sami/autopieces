<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model {
    use HasFactory;
    protected $fillable = ['order_number','user_id','status','payment_method','payment_status','shipping_first_name','shipping_last_name','shipping_phone','shipping_address','shipping_city','shipping_state','shipping_country','subtotal','shipping_cost','discount','total','coupon_code','notes','tracking_number','shipped_at','delivered_at'];
    protected $casts = ['subtotal'=>'decimal:3','shipping_cost'=>'decimal:3','discount'=>'decimal:3','total'=>'decimal:3','shipped_at'=>'datetime','delivered_at'=>'datetime'];
    const STATUSES = ['pending'=>['label'=>'En attente','color'=>'warning'],'confirmed'=>['label'=>'Confirmée','color'=>'info'],'processing'=>['label'=>'En traitement','color'=>'primary'],'shipped'=>['label'=>'Expédiée','color'=>'info'],'delivered'=>['label'=>'Livrée','color'=>'success'],'cancelled'=>['label'=>'Annulée','color'=>'danger']];
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function statusHistory() { return $this->hasMany(OrderStatusHistory::class)->latest(); }
    public function getStatusLabelAttribute(): string { return self::STATUSES[$this->status]['label'] ?? $this->status; }
    public function getStatusColorAttribute(): string { return self::STATUSES[$this->status]['color'] ?? 'secondary'; }
    public static function generateOrderNumber(): string { return 'AP-'.date('Y').'-'.str_pad(static::whereYear('created_at',date('Y'))->count()+1,5,'0',STR_PAD_LEFT); }
}
