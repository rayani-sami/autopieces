<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller {
    public function index() {
        $stats = [
            'orders_today'=>Order::whereDate('created_at',today())->count(),
            'orders_month'=>Order::whereMonth('created_at',now()->month)->count(),
            'revenue_month'=>Order::whereMonth('created_at',now()->month)->where('status','!=','cancelled')->sum('total'),
            'pending_orders'=>Order::where('status','pending')->count(),
            'total_products'=>Product::active()->count(),
            'low_stock'=>Product::where('stock','<',5)->where('stock','>=',0)->count(),
            'total_users'=>User::count(),
            'total_categories'=>Category::count(),
        ];
        $recentOrders = Order::with('user')->latest()->take(10)->get();
        $monthlyRevenue = Order::select(DB::raw('MONTH(created_at) as month'),DB::raw('SUM(total) as total'))->whereYear('created_at',now()->year)->where('status','!=','cancelled')->groupBy('month')->orderBy('month')->get();
        return view('admin.dashboard.index',compact('stats','recentOrders','monthlyRevenue'));
    }
}
