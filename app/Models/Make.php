<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Make extends Model {
    use HasFactory;
    protected $fillable = ['name','slug','logo','is_active','sort_order'];
    protected $casts = ['is_active'=>'boolean'];
    public function models() { return $this->hasMany(CarModel::class); }
    public function getRouteKeyName(): string { return 'slug'; }
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('sort_order')->orderBy('name'); }
}
