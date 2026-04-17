<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Make;
use App\Models\CarModel;
use App\Models\Engine;
use App\Models\Category;
use App\Models\Product;
use App\Services\VehicleService;
use Illuminate\Http\Request;
class VehicleController extends Controller {
    public function __construct(protected VehicleService $vehicleService) {}
    public function models(string $makeSlug) {
        $make = Make::where('slug',$makeSlug)->active()->firstOrFail();
        $models = $make->models()->active()->get();
        return view('frontend.vehicle.models',compact('make','models'));
    }
    public function engines(string $makeSlug, string $modelSlug) {
        $make = Make::where('slug',$makeSlug)->firstOrFail();
        $model = CarModel::where('make_id',$make->id)->where('slug',$modelSlug)->firstOrFail();
        $engines = $model->engines()->active()->get();
        return view('frontend.vehicle.engines',compact('make','model','engines'));
    }
    public function parts(string $makeSlug, string $modelSlug, string $engineSlug) {
        $make = Make::where('slug',$makeSlug)->firstOrFail();
        $model = CarModel::where('make_id',$make->id)->where('slug',$modelSlug)->firstOrFail();
        $engine = Engine::where('car_model_id',$model->id)->where('slug',$engineSlug)->firstOrFail();
        $this->vehicleService->setSelectedVehicle($engine->id);
        $categories = Category::root()->active()->whereHas('products.engines',fn($q)=>$q->where('engines.id',$engine->id))->with('children')->orderBy('sort_order')->get();
        $featuredProducts = Product::active()->with(['images','category'])->whereHas('engines',fn($q)=>$q->where('engines.id',$engine->id))->featured()->take(8)->get();
        return view('frontend.vehicle.parts',compact('make','model','engine','categories','featuredProducts'));
    }
    public function categoryParts(string $makeSlug, string $modelSlug, string $engineSlug, string $categorySlug) {
        $make = Make::where('slug',$makeSlug)->firstOrFail();
        $model = CarModel::where('make_id',$make->id)->where('slug',$modelSlug)->firstOrFail();
        $engine = Engine::where('car_model_id',$model->id)->where('slug',$engineSlug)->firstOrFail();
        $category = Category::where('slug',$categorySlug)->firstOrFail();
        $this->vehicleService->setSelectedVehicle($engine->id);
        $childIds = $category->children->pluck('id')->push($category->id);
        $products = Product::active()->with(['images','category'])->whereIn('category_id',$childIds)->whereHas('engines',fn($q)=>$q->where('engines.id',$engine->id))->orderBy('sort_order')->paginate(24);
        return view('frontend.vehicle.category_parts',compact('make','model','engine','category','products'));
    }
    public function select(int $engineId) {
        $this->vehicleService->setSelectedVehicle($engineId);
        return back()->with('success','Véhicule sélectionné.');
    }
    public function clear() {
        $this->vehicleService->clearSelectedVehicle();
        return back()->with('success','Véhicule effacé.');
    }
}
