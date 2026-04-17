@extends('layouts.app')
@section('title','Mon compte - AutoPart')
@section('content')
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mon compte</h1>
  <div class="row g-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center p-4">
          <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px;font-size:1.5rem">{{ strtoupper(substr($user->first_name,0,1)) }}</div>
          <h6 class="fw-bold mb-0">{{ $user->full_name }}</h6>
          <div class="text-muted small">{{ $user->email }}</div>
        </div>
        <div class="list-group list-group-flush">
          <a href="{{ route('account.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.index')?'active':'' }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
          <a href="{{ route('account.orders') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.orders*')?'active':'' }}"><i class="fas fa-shopping-bag me-2"></i>Mes commandes</a>
          <a href="{{ route('account.addresses') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.addresses*')?'active':'' }}"><i class="fas fa-map-marker-alt me-2"></i>Mes adresses</a>
          <a href="{{ route('account.vehicles') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.vehicles*')?'active':'' }}"><i class="fas fa-car me-2"></i>Mes véhicules</a>
          <a href="{{ route('account.profile') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.profile*')?'active':'' }}"><i class="fas fa-user me-2"></i>Mon profil</a>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="card border-0 shadow-sm text-center p-3"><div class="fs-2 fw-bold text-danger">{{ $user->orders->count() }}</div><div class="text-muted small">Commandes</div></div></div>
        <div class="col-md-4"><div class="card border-0 shadow-sm text-center p-3"><div class="fs-2 fw-bold text-success">{{ $user->orders->where('status','delivered')->count() }}</div><div class="text-muted small">Livrées</div></div></div>
        <div class="col-md-4"><div class="card border-0 shadow-sm text-center p-3"><div class="fs-2 fw-bold text-warning">{{ $user->orders->where('status','pending')->count() }}</div><div class="text-muted small">En attente</div></div></div>
      </div>
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Dernières commandes</h5>
          @forelse($user->orders->take(5) as $order)
          <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
            <div>
              <a href="{{ route('account.order.detail',$order) }}" class="text-decoration-none fw-semibold">{{ $order->order_number }}</a>
              <div class="text-muted small">{{ $order->created_at->format('d/m/Y') }} · {{ $order->items->count() }} article(s)</div>
            </div>
            <div class="text-end">
              <span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
              <div class="fw-bold mt-1">{{ number_format($order->total,3) }} TND</div>
            </div>
          </div>
          @empty
          <p class="text-muted">Aucune commande pour le moment.</p>
          @endforelse
          <a href="{{ route('account.orders') }}" class="btn btn-outline-danger btn-sm mt-3">Voir toutes mes commandes</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
