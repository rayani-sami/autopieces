<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(protected VehicleService $vehicleService) {}

    public function index(Request $request)
    {
        $query  = trim($request->get('q', ''));
        $engine = $this->vehicleService->getSelectedEngine();
        $products = collect();
        $categories = collect();

        if (mb_strlen($query) >= 2) {
            $q = Product::active()->with(['images', 'category'])
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%$query%")
                      ->orWhere('reference', 'like', "%$query%")
                      ->orWhere('oem_reference', 'like', "%$query%")
                      ->orWhere('brand', 'like', "%$query%")
                      ->orWhere('description', 'like', "%$query%");
                });

            if ($engine) {
                $q->whereHas('engines', fn($e) => $e->where('engines.id', $engine->id));
            }

            // Filters
            if ($request->filled('brand'))     $q->where('brand', $request->brand);
            if ($request->filled('min_price')) $q->where('price', '>=', $request->min_price);
            if ($request->filled('max_price')) $q->where('price', '<=', $request->max_price);
            if ($request->filled('category_id')) $q->where('category_id', $request->category_id);

            match ($request->get('sort', 'relevance')) {
                'price_asc'  => $q->orderBy('price'),
                'price_desc' => $q->orderByDesc('price'),
                'newest'     => $q->orderByDesc('created_at'),
                default      => $q->orderByDesc('is_featured')->orderBy('sort_order'),
            };

            $products   = $q->paginate(24)->withQueryString();
            $categories = Category::active()->whereHas('products', function($q) use ($query) {
                $q->active()->where('name', 'like', "%$query%");
            })->get();
        }

        // AJAX autocomplete
        if ($request->ajax() && $request->filled('q')) {
            $suggestions = Product::active()
                ->select('id', 'name', 'reference', 'price', 'slug', 'thumbnail')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%$query%")
                      ->orWhere('reference', 'like', "%$query%");
                })
                ->take(8)->get();
            return response()->json($suggestions);
        }

        return view('frontend.catalog.search', compact('products', 'query', 'engine', 'categories'));
    }

    public function byRegistration(Request $request)
    {
        $request->validate([
            'plate'      => 'required|string|max:20|regex:/^[0-9]+$/',
            'plate_type' => 'required|in:TU,RS',
        ], [
            'plate.regex' => 'Le numéro d\'immatriculation doit contenir uniquement des chiffres.',
        ]);

        $plate  = strtoupper($request->plate_type) . preg_replace('/\s+/', '', $request->plate);
        $engine = $this->vehicleService->findByRegistration($plate);

        if (!$engine) {
            return back()->with('error', 'Immatriculation introuvable. Veuillez sélectionner votre véhicule manuellement.');
        }

        $this->vehicleService->setSelectedVehicle($engine->id);
        $make  = $engine->carModel->make;
        $model = $engine->carModel;

        return redirect()
            ->route('vehicle.parts', [$make->slug, $model->slug, $engine->slug])
            ->with('success', 'Véhicule trouvé : ' . $make->name . ' ' . $model->name . ' ' . $engine->full_name);
    }
}
