<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class CategoryAdminController extends Controller {
    public function index() { $categories = Category::with('parent','children')->orderBy('sort_order')->get(); return view('admin.categories.index',compact('categories')); }
    public function create() { $parents = Category::root()->active()->orderBy('name')->get(); return view('admin.categories.create',compact('parents')); }
    public function store(Request $request) {
        $validated = $request->validate(['name'=>'required|string|max:255','parent_id'=>'nullable|exists:categories,id','description'=>'nullable|string','is_active'=>'boolean','sort_order'=>'integer']);
        $validated['slug'] = Str::slug($validated['name'].'-'.time());
        $category = Category::create($validated);
        if ($request->hasFile('image')) { $category->update(['image'=>$request->file('image')->store('categories','public')]); }
        return redirect()->route('admin.categories.index')->with('success','Catégorie créée.');
    }
    public function edit(Category $category) { $parents = Category::root()->active()->where('id','!=',$category->id)->orderBy('name')->get(); return view('admin.categories.edit',compact('category','parents')); }
    public function update(Request $request, Category $category) {
        $validated = $request->validate(['name'=>'required|string|max:255','parent_id'=>'nullable|exists:categories,id','description'=>'nullable|string']);
        $category->update($validated+$request->only('is_active','sort_order'));
        if ($request->hasFile('image')) { if ($category->image) Storage::disk('public')->delete($category->image); $category->update(['image'=>$request->file('image')->store('categories','public')]); }
        return back()->with('success','Catégorie mise à jour.');
    }
    public function destroy(Category $category) { $category->delete(); return redirect()->route('admin.categories.index')->with('success','Catégorie supprimée.'); }
}
