<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\VehicleService;
class ProductController extends Controller {
    public function __construct(protected VehicleService $vehicleService) {}
    public function show(string $slug) {
        $product = Product::where('slug',$slug)->active()->with(['images','category','engines.carModel.make'])->firstOrFail();
        $product->increment('views');
        $engine = $this->vehicleService->getSelectedEngine();
        $related = Product::active()->where('category_id',$product->category_id)->where('id','!=',$product->id)->with('images')->take(6)->get();
        return view('frontend.catalog.product',compact('product','engine','related'));
    }
}
