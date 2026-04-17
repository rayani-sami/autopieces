<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\VehicleService;
use Illuminate\Http\Request;
class CatalogController extends Controller {
    public function __construct(protected VehicleService $vehicleService) {}
    public function category(string $slug, Request $request) {
        $category = Category::where('slug',$slug)->with('children','parent')->firstOrFail();
        $engine = $this->vehicleService->getSelectedEngine();
        $childIds = $category->children->pluck('id')->push($category->id);
        $query = Product::active()->with(['images','category'])->whereIn('category_id',$childIds);
        if ($engine) $query->whereHas('engines',fn($q)=>$q->where('engines.id',$engine->id));
        if ($request->filled('brand')) $query->where('brand',$request->brand);
        if ($request->filled('min_price')) $query->where('price','>=',$request->min_price);
        if ($request->filled('max_price')) $query->where('price','<=',$request->max_price);
        match($request->sort??'default') {
            'price_asc'=>$query->orderBy('price'),
            'price_desc'=>$query->orderByDesc('price'),
            'newest'=>$query->orderByDesc('created_at'),
            default=>$query->orderBy('sort_order')->orderByDesc('is_featured'),
        };
        $products = $query->paginate(24)->withQueryString();
        $brands = Product::active()->whereIn('category_id',$childIds)->whereNotNull('brand')->distinct()->pluck('brand');
        return view('frontend.catalog.category',compact('category','products','brands','engine'));
    }
}
