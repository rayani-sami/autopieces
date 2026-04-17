<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserVehicle extends Model {
    protected $fillable = ['user_id','engine_id','label','plate'];
    public function user() { return $this->belongsTo(User::class); }
    public function engine() { return $this->belongsTo(Engine::class)->with(['carModel.make']); }
}
