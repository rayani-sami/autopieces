<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Make;
use App\Models\CarModel;
use App\Models\Engine;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VehicleAdminController extends Controller
{
    // ---- MAKES ----
    public function index()
    {
        $makes = Make::withCount('models')->orderBy('sort_order')->get();
        return view('admin.vehicles.makes', compact('makes'));
    }

    public function create()
    {
        return view('admin.vehicles.make_create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $make = Make::create([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);
        if ($request->hasFile('logo')) {
            $make->update(['logo' => $request->file('logo')->store('makes', 'public')]);
        }
        return redirect()->route('admin.marques.index')->with('success', 'Marque créée avec succès.');
    }

    public function edit(Make $make)
    {
        return view('admin.vehicles.make_edit', compact('make'));
    }

    public function update(Request $request, Make $make)
    {
        $make->update([
            'name'       => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);
        if ($request->hasFile('logo')) {
            if ($make->logo) Storage::disk('public')->delete($make->logo);
            $make->update(['logo' => $request->file('logo')->store('makes', 'public')]);
        }
        return back()->with('success', 'Marque mise à jour.');
    }

    public function destroy(Make $make)
    {
        $make->delete();
        return redirect()->route('admin.marques.index')->with('success', 'Marque supprimée.');
    }

    // ---- MODELS ----
    public function modelIndex(Make $make)
    {
        $models = $make->models()->withCount('engines')->orderBy('name')->get();
        return view('admin.vehicles.models', compact('make', 'models'));
    }

    public function modelStore(Request $request, Make $make)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'year_from' => 'nullable|integer|min:1950|max:2030',
            'year_to'   => 'nullable|integer|min:1950|max:2030',
        ]);
        $make->models()->create([
            'name'      => $request->name,
            'slug'      => Str::slug($request->name . '-' . $make->slug . '-' . time()),
            'year_from' => $request->year_from,
            'year_to'   => $request->year_to,
            'is_active' => $request->boolean('is_active', true),
        ]);
        return back()->with('success', 'Modèle ajouté.');
    }

    public function modelDestroy(CarModel $model)
    {
        $model->delete();
        return back()->with('success', 'Modèle supprimé.');
    }

    // ---- ENGINES ----
    public function engineIndex(CarModel $model)
    {
        $model->load('make');
        $engines = $model->engines()->orderBy('name')->get();
        return view('admin.vehicles.engines', compact('model', 'engines'));
    }

    public function engineStore(Request $request, CarModel $model)
    {
        $request->validate([
            'name'      => 'required|string|max:200',
            'fuel_type' => 'nullable|string|max:50',
            'year_from' => 'nullable|integer|min:1950|max:2030',
            'year_to'   => 'nullable|integer|min:1950|max:2030',
        ]);
        $model->engines()->create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name . '-' . time()),
            'fuel_type'   => $request->fuel_type,
            'displacement'=> $request->displacement,
            'power_hp'    => $request->power_hp,
            'engine_code' => $request->engine_code,
            'year_from'   => $request->year_from,
            'year_to'     => $request->year_to,
            'is_active'   => $request->boolean('is_active', true),
        ]);
        return back()->with('success', 'Motorisation ajoutée.');
    }

    public function engineDestroy(Engine $engine)
    {
        $engine->delete();
        return back()->with('success', 'Motorisation supprimée.');
    }

    // ---- CSV IMPORT ----
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:csv,txt|max:5120']);
        $handle = fopen($request->file('file')->getPathname(), 'r');
        $header = fgetcsv($handle);
        $count  = 0;
        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < count($header)) continue;
            $data  = array_combine($header, $row);
            $make  = Make::firstOrCreate(
                ['slug' => Str::slug($data['make'])],
                ['name' => trim($data['make']), 'is_active' => true]
            );
            $model = CarModel::firstOrCreate(
                ['make_id' => $make->id, 'slug' => Str::slug(trim($data['model']) . '-' . $make->slug)],
                ['name' => trim($data['model']), 'is_active' => true]
            );
            Engine::firstOrCreate(
                ['car_model_id' => $model->id, 'slug' => Str::slug(trim($data['engine']) . '-' . time() . '-' . $count)],
                [
                    'name'         => trim($data['engine']),
                    'fuel_type'    => $data['fuel_type']    ?? null,
                    'displacement' => $data['displacement'] ?? null,
                    'power_hp'     => $data['power_hp']     ?? null,
                    'engine_code'  => $data['engine_code']  ?? null,
                    'year_from'    => $data['year_from']    ?? null,
                    'year_to'      => $data['year_to']      ?? null,
                    'is_active'    => true,
                ]
            );
            $count++;
        }
        fclose($handle);
        return back()->with('success', "$count véhicule(s) importés avec succès.");
    }
}
