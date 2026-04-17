@extends('layouts.app')
@section('title','Mes commandes - AutoPart')
@section('content')
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mes commandes</h1>
  @forelse($orders as $order)
  <div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h6 class="fw-bold mb-1"><a href="{{ route('account.order.detail',$order) }}" class="text-decoration-none text-dark">{{ $order->order_number }}</a></h6>
          <div class="text-muted small">{{ $order->created_at->format('d/m/Y à H:i') }}</div>
          <div class="mt-2">@foreach($order->items->take(3) as $item)<span class="badge bg-light text-dark border me-1 small">{{ Str::limit($item->product_name,25) }}</span>@endforeach</div>
        </div>
        <div class="text-end">
          <span class="badge bg-{{ $order->status_color }} mb-1">{{ $order->status_label }}</span>
          <div class="fw-bold text-danger">{{ number_format($order->total,3) }} TND</div>
          <a href="{{ route('account.order.detail',$order) }}" class="btn btn-outline-danger btn-sm mt-2">Détails</a>
        </div>
      </div>
    </div>
  </div>
  @empty
  <div class="text-center py-5 text-muted"><i class="fas fa-shopping-bag fa-3x mb-3"></i><h5>Aucune commande</h5><a href="{{ route('home') }}" class="btn btn-danger mt-2">Commencer mes achats</a></div>
  @endforelse
  {{ $orders->links() }}
</div>
@endsection
