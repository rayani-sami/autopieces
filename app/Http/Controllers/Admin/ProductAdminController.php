<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Engine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class ProductAdminController extends Controller {
    public function index(Request $request) {
        $query = Product::withTrashed()->with('category')->orderByDesc('created_at');
        if ($request->filled('search')) $query->where('name','like','%'.$request->search.'%')->orWhere('reference','like','%'.$request->search.'%');
        if ($request->filled('category')) $query->where('category_id',$request->category);
        if ($request->filled('status')) $request->status==='active'?$query->whereNull('deleted_at'):$query->onlyTrashed();
        $products = $query->paginate(25)->withQueryString();
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.products.index',compact('products','categories'));
    }
    public function create() {
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.products.create',compact('categories'));
    }
    public function store(Request $request) {
        $validated = $request->validate(['name'=>'required|string|max:255','category_id'=>'required|exists:categories,id','price'=>'required|numeric|min:0','stock'=>'required|integer|min:0','description'=>'nullable|string','reference'=>'nullable|string|max:100','brand'=>'nullable|string|max:100']);
        $validated['slug'] = Str::slug($validated['name'].'-'.time());
        $product = Product::create($validated+$request->only('oem_reference','technical_specs','price_old','is_active','is_featured','is_new','sort_order'));
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products','public');
            $product->update(['thumbnail'=>$path]);
        }
        return redirect()->route('admin.produits.edit',$product)->with('success','Produit créé avec succès.');
    }
    public function edit(Product $produit) {
        $categories = Category::active()->orderBy('name')->get();
        $images = $produit->images;
        return view('admin.products.edit',compact('produit','categories','images'));
    }
    public function update(Request $request, Product $produit) {
        $validated = $request->validate(['name'=>'required|string|max:255','category_id'=>'required|exists:categories,id','price'=>'required|numeric|min:0','stock'=>'required|integer|min:0']);
        $produit->update($validated+$request->only('description','reference','oem_reference','brand','technical_specs','price_old','is_active','is_featured','is_new','sort_order'));
        if ($request->hasFile('thumbnail')) {
            if ($produit->thumbnail) Storage::disk('public')->delete($produit->thumbnail);
            $path = $request->file('thumbnail')->store('products','public');
            $produit->update(['thumbnail'=>$path]);
        }
        return back()->with('success','Produit mis à jour.');
    }
    public function destroy(Product $produit) { $produit->delete(); return redirect()->route('admin.produits.index')->with('success','Produit supprimé.'); }
    public function uploadImage(Request $request, Product $product) {
        $request->validate(['image'=>'required|image|max:5120']);
        $path = $request->file('image')->store('products/gallery','public');
        $image = $product->images()->create(['path'=>$path,'alt'=>$product->name,'sort_order'=>$product->images()->count()]);
        if ($request->ajax()) return response()->json(['success'=>true,'image'=>$image]);
        return back()->with('success','Image ajoutée.');
    }
    public function deleteImage(ProductImage $image) {
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return back()->with('success','Image supprimée.');
    }
    public function updateCompatibilities(Request $request, Product $product) {
        $engineIds = $request->input('engine_ids',[]);
        $product->engines()->sync($engineIds);
        return back()->with('success','Compatibilités mises à jour.');
    }
}
