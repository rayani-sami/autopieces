<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
class OrderAdminController extends Controller {
    public function __construct(protected OrderService $orderService) {}
    public function index(Request $request) {
        $query = Order::with('user')->latest();
        if ($request->filled('status')) $query->where('status',$request->status);
        if ($request->filled('search')) $query->where('order_number','like','%'.$request->search.'%')->orWhereHas('user',fn($q)=>$q->where('email','like','%'.$request->search.'%'));
        if ($request->filled('date_from')) $query->whereDate('created_at','>=',$request->date_from);
        if ($request->filled('date_to')) $query->whereDate('created_at','<=',$request->date_to);
        $orders = $query->paginate(25)->withQueryString();
        $statusCounts = Order::selectRaw('status, count(*) as count')->groupBy('status')->pluck('count','status');
        return view('admin.orders.index',compact('orders','statusCounts'));
    }
    public function show(Order $order) { return view('admin.orders.show',['order'=>$order->load('items.product','user','statusHistory.user')]); }
    public function updateStatus(Request $request, Order $order) {
        $request->validate(['status'=>'required|in:pending,confirmed,processing,shipped,delivered,cancelled','comment'=>'nullable|string|max:500']);
        $this->orderService->updateStatus($order,$request->status,$request->comment??'');
        return back()->with('success','Statut mis à jour: '.$order->refresh()->status_label);
    }
    public function invoice(Order $order) {
        $pdf = Pdf::loadView('admin.orders.invoice',['order'=>$order->load('items.product','user')]);
        return $pdf->download('facture-'.$order->order_number.'.pdf');
    }
}
