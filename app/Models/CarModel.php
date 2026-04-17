<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CarModel extends Model {
    use HasFactory;
    protected $table = 'car_models';
    protected $fillable = ['make_id','name','slug','image','year_from','year_to','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function make() { return $this->belongsTo(Make::class); }
    public function engines() { return $this->hasMany(Engine::class); }
    public function getRouteKeyName(): string { return 'slug'; }
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('name'); }
}
