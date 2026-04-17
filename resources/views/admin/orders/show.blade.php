@extends('layouts.admin')
@section('page-title','Commande '.$order->order_number)
@section('content')
<div class="row g-4">
  <div class="col-md-8">
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Articles</h5>
        <a href="{{ route('admin.commandes.invoice',$order) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf me-1"></i>PDF</a>
      </div>
      <div class="table-responsive">
        <table class="table mb-0">
          <thead class="table-light"><tr><th>Produit</th><th>Réf.</th><th>Qté</th><th>Prix unit.</th><th>Total</th></tr></thead>
          <tbody>
            @foreach($order->items as $item)
            <tr><td>{{ $item->product_name }}</td><td class="text-muted small">{{ $item->product_reference }}</td><td>{{ $item->quantity }}</td><td>{{ number_format($item->unit_price,3) }}</td><td class="fw-bold">{{ number_format($item->total_price,3) }}</td></tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer bg-white">
        <div class="row justify-content-end">
          <div class="col-md-4">
            <div class="d-flex justify-content-between mb-1"><span class="text-muted">Sous-total</span><span>{{ number_format($order->subtotal,3) }} TND</span></div>
            @if($order->discount > 0)<div class="d-flex justify-content-between mb-1 text-success"><span>Réduction</span><span>-{{ number_format($order->discount,3) }} TND</span></div>@endif
            <div class="d-flex justify-content-between mb-1"><span class="text-muted">Livraison</span><span>{{ number_format($order->shipping_cost,3) }} TND</span></div>
            <div class="d-flex justify-content-between fw-bold fs-5 pt-2 border-top"><span>Total</span><span class="text-danger">{{ number_format($order->total,3) }} TND</span></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Status update -->
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h5 class="fw-bold mb-3">Changer le statut</h5>
        <form action="{{ route('admin.commandes.status',$order) }}" method="POST" class="row g-2">
          @csrf @method('PATCH')
          <div class="col-md-4">
            <select name="status" class="form-select">
              @foreach(\App\Models\Order::STATUSES as $k=>$v)<option value="{{ $k }}" {{ $order->status===$k?'selected':'' }}>{{ $v['label'] }}</option>@endforeach
            </select>
          </div>
          <div class="col-md-6"><input type="text" name="comment" class="form-control" placeholder="Commentaire (optionnel)"></div>
          <div class="col-md-2"><button type="submit" class="btn btn-danger w-100">Mettre à jour</button></div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-body">
        <h6 class="fw-bold mb-3">Livraison</h6>
        <p class="mb-1 fw-semibold">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
        <p class="mb-1 text-muted small">{{ $order->shipping_address }}</p>
        <p class="mb-1 text-muted small">{{ $order->shipping_city }}{{ $order->shipping_state ? ', '.$order->shipping_state : '' }}</p>
        <p class="mb-0 text-muted small"><i class="fas fa-phone me-1"></i>{{ $order->shipping_phone }}</p>
        @if($order->notes)<div class="alert alert-info-subtle mt-2 p-2 small"><strong>Note:</strong> {{ $order->notes }}</div>@endif
      </div>
    </div>
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="fw-bold mb-3">Historique</h6>
        @foreach($order->statusHistory as $h)
        <div class="d-flex gap-2 mb-2">
          <div class="text-muted small text-nowrap">{{ $h->created_at->format('d/m H:i') }}</div>
          <div><span class="badge bg-secondary small">{{ \App\Models\Order::STATUSES[$h->status]['label'] ?? $h->status }}</span>@if($h->comment)<div class="text-muted" style="font-size:11px">{{ $h->comment }}</div>@endif</div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
