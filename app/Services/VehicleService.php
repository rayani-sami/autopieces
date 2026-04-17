<?php
namespace App\Services;
use App\Models\Make;
use App\Models\CarModel;
use App\Models\Engine;
use App\Models\Registration;
use Illuminate\Support\Facades\Session;
class VehicleService {
    public function setSelectedVehicle(int $engineId): void { Session::put('selected_engine_id',$engineId); }
    public function getSelectedEngine(): ?Engine {
        $id = Session::get('selected_engine_id');
        if (!$id) return null;
        return Engine::with(['carModel.make'])->find($id);
    }
    public function clearSelectedVehicle(): void { Session::forget('selected_engine_id'); }
    public function findByRegistration(string $plate): ?Engine {
        $reg = Registration::where('plate',strtoupper(trim($plate)))->with('engine.carModel.make')->first();
        return $reg?->engine;
    }
    public function getAllMakes() { return Make::active()->get(); }
    public function getModelsByMake(Make $make) { return $make->models()->active()->get(); }
    public function getEnginesByModel(CarModel $model) { return $model->engines()->active()->get(); }
}
