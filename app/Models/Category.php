<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model {
    use HasFactory;
    protected $fillable = ['parent_id','name','slug','description','image','is_active','sort_order'];
    protected $casts = ['is_active'=>'boolean'];
    public function parent() { return $this->belongsTo(Category::class,'parent_id'); }
    public function children() { return $this->hasMany(Category::class,'parent_id')->orderBy('sort_order'); }
    public function products() { return $this->hasMany(Product::class); }
    public function getRouteKeyName(): string { return 'slug'; }
    public function scopeActive($q) { return $q->where('is_active',true); }
    public function scopeRoot($q) { return $q->whereNull('parent_id'); }
}
