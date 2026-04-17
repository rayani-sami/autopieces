<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Coupon extends Model {
    protected $fillable = ['code','type','value','min_order','usage_limit','used_count','expires_at','is_active'];
    protected $casts = ['is_active'=>'boolean','expires_at'=>'date','value'=>'decimal:3','min_order'=>'decimal:3'];
    public function isValid(): bool {
        if (!$this->is_active) return false;
        if ($this->expires_at && $this->expires_at->isPast()) return false;
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) return false;
        return true;
    }
    public function calculateDiscount(float $subtotal): float {
        if ($subtotal < $this->min_order) return 0;
        if ($this->type === 'percentage') return round($subtotal * $this->value / 100, 3);
        return min($this->value, $subtotal);
    }
}
