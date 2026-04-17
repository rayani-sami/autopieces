<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Make;
use App\Models\Product;
use Illuminate\Http\Request;
class HomeController extends Controller {
    public function index() {
        $banners = Banner::active()->get();
        $rootCategories = Category::root()->active()->with('children')->orderBy('sort_order')->get();
        $makes = Make::active()->get();
        $featuredProducts = Product::active()->featured()->with(['images','category'])->take(12)->get();
        $newProducts = Product::active()->where('is_new',true)->with(['images','category'])->take(8)->get();
        return view('frontend.home.index',compact('banners','rootCategories','makes','featuredProducts','newProducts'));
    }
    public function contact(Request $request) {
        $request->validate(['name'=>'required|string|max:100','email'=>'required|email','subject'=>'required|string|max:200','message'=>'required|string|max:2000']);
        try {
            \Mail::send('emails.contact',$request->only('name','email','subject','message'),function($m) use ($request) {
                $m->to('autopart.tunisia@gmail.com')->subject('Contact: '.$request->subject);
            });
            return back()->with('success','Votre message a été envoyé avec succès !');
        } catch(\Exception $e) {
            return back()->with('error','Erreur lors de l\'envoi. Veuillez réessayer.');
        }
    }
}
