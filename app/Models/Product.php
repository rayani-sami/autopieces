<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model {
    use HasFactory, SoftDeletes;
    protected $fillable = ['category_id','name','slug','reference','oem_reference','description','technical_specs','price','price_old','stock','brand','thumbnail','is_active','is_featured','is_new','sort_order','views'];
    protected $casts = ['is_active'=>'boolean','is_featured'=>'boolean','is_new'=>'boolean','price'=>'decimal:3','price_old'=>'decimal:3'];
    public function category() { return $this->belongsTo(Category::class); }
    public function images() { return $this->hasMany(ProductImage::class)->orderBy('sort_order'); }
    public function engines() { return $this->belongsToMany(Engine::class,'engine_product'); }
    public function getRouteKeyName(): string { return 'slug'; }
    public function getDiscountPercentAttribute(): ?int {
        if ($this->price_old && $this->price_old > $this->price)
            return round((($this->price_old - $this->price) / $this->price_old) * 100);
        return null;
    }
    public function getIsInStockAttribute(): bool { return $this->stock > 0; }
    public function scopeActive($q) { return $q->where('is_active',true); }
    public function scopeFeatured($q) { return $q->where('is_featured',true); }
    public function scopeForEngine($q, $engineId) { return $q->whereHas('engines',fn($e)=>$e->where('engines.id',$engineId)); }
}
