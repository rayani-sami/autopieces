@extends('layouts.app')
@section('title','Commande '.$order->order_number.' - AutoPart')
@section('content')
<div class="container py-4">
  <div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('account.orders') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i></a>
    <h1 class="fw-bold mb-0">Commande {{ $order->order_number }}</h1>
    <span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
  </div>
  <div class="row g-4">
    <div class="col-md-8">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Articles commandés</h5>
          @foreach($order->items as $item)
          <div class="d-flex justify-content-between py-2 border-bottom">
            <div><div class="fw-semibold">{{ $item->product_name }}</div>@if($item->product_reference)<div class="text-muted small">Réf: {{ $item->product_reference }}</div>@endif<div class="text-muted small">{{ number_format($item->unit_price,3) }} TND × {{ $item->quantity }}</div></div>
            <div class="fw-bold">{{ number_format($item->total_price,3) }} TND</div>
          </div>
          @endforeach
          <div class="mt-3">
            <div class="d-flex justify-content-between text-muted mb-1"><span>Sous-total</span><span>{{ number_format($order->subtotal,3) }} TND</span></div>
            @if($order->discount > 0)<div class="d-flex justify-content-between text-success mb-1"><span>Réduction</span><span>-{{ number_format($order->discount,3) }} TND</span></div>@endif
            <div class="d-flex justify-content-between text-muted mb-1"><span>Livraison</span><span>{{ $order->shipping_cost > 0 ? number_format($order->shipping_cost,3).' TND' : 'Gratuite' }}</span></div>
            <div class="d-flex justify-content-between fw-bold fs-5 mt-2 pt-2 border-top"><span>Total</span><span class="text-danger">{{ number_format($order->total,3) }} TND</span></div>
          </div>
        </div>
      </div>
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Historique du statut</h5>
          @foreach($order->statusHistory as $history)
          <div class="d-flex gap-3 mb-3">
            <div class="text-muted small text-nowrap">{{ $history->created_at->format('d/m/Y H:i') }}</div>
            <div><span class="badge bg-secondary">{{ \App\Models\Order::STATUSES[$history->status]['label'] ?? $history->status }}</span>@if($history->comment)<div class="text-muted small mt-1">{{ $history->comment }}</div>@endif</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Livraison</h5>
          <p class="mb-1 fw-semibold">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
          <p class="mb-1 text-muted small">{{ $order->shipping_address }}</p>
          <p class="mb-1 text-muted small">{{ $order->shipping_city }}{{ $order->shipping_state ? ', '.$order->shipping_state : '' }}</p>
          <p class="mb-0 text-muted small">{{ $order->shipping_phone }}</p>
          @if($order->tracking_number)<div class="mt-2"><span class="fw-semibold small">Tracking:</span> <span class="badge bg-info">{{ $order->tracking_number }}</span></div>@endif
        </div>
      </div>
      <a href="https://wa.me/21623136136?text=Bonjour, question sur ma commande {{ $order->order_number }}" target="_blank" class="btn btn-success w-100"><i class="fab fa-whatsapp me-2"></i>Support WhatsApp</a>
    </div>
  </div>
</div>
@endsection
