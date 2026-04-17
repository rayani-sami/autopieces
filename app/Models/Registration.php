<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Registration extends Model {
    protected $fillable = ['plate','plate_type','engine_id'];
    public function engine() { return $this->belongsTo(Engine::class); }
}
