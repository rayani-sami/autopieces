<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Banner;
use Illuminate\Http\Request;
class SettingAdminController extends Controller {
    public function index() { $settings=Setting::pluck('value','key'); $banners=Banner::orderBy('sort_order')->get(); return view('admin.settings.index',compact('settings','banners')); }
    public function update(Request $request) {
        foreach ($request->except(['_token','_method']) as $key=>$value) Setting::set($key,$value);
        return back()->with('success','Paramètres sauvegardés.');
    }
    public function storeBanner(Request $request) {
        $request->validate(['image'=>'required|image|max:5120','title'=>'nullable|string|max:255','link'=>'nullable|string|max:255']);
        $path = $request->file('image')->store('banners','public');
        Banner::create(['image'=>$path,'title'=>$request->title,'subtitle'=>$request->subtitle,'link'=>$request->link,'button_text'=>$request->button_text,'is_active'=>true,'sort_order'=>Banner::count()]);
        return back()->with('success','Bannière ajoutée.');
    }
    public function destroyBanner(Banner $banner) { $banner->delete(); return back()->with('success','Bannière supprimée.'); }
}
