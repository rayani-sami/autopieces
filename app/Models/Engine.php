<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Engine extends Model {
    use HasFactory;
    protected $fillable = ['car_model_id','name','slug','fuel_type','displacement','power_hp','engine_code','year_from','year_to','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function carModel() { return $this->belongsTo(CarModel::class); }
    public function products() { return $this->belongsToMany(Product::class,'engine_product'); }
    public function registrations() { return $this->hasMany(Registration::class); }
    public function getFullNameAttribute(): string { return trim($this->name.' '.$this->displacement.' '.$this->fuel_type); }
    public function scopeActive($q) { return $q->where('is_active',true); }
}
