@extends('layouts.app')
@section('title','Commande confirmée - AutoPart')
@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <div class="mb-4"><i class="fas fa-check-circle text-success" style="font-size:5rem"></i></div>
    <h1 class="fw-bold text-success">Commande confirmée !</h1>
    <p class="lead text-muted">Merci {{ $order->shipping_first_name }} ! Votre commande a été passée avec succès.</p>
    <div class="badge bg-danger fs-5 px-4 py-2">{{ $order->order_number }}</div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-0 shadow mb-4">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Détails de la commande</h5>
          @foreach($order->items as $item)
          <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
            <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
            <span class="fw-bold">{{ number_format($item->total_price,3) }} TND</span>
          </div>
          @endforeach
          <div class="d-flex justify-content-between mt-2"><span>Livraison</span><span>{{ $order->shipping_cost > 0 ? number_format($order->shipping_cost,3).' TND' : 'Gratuite' }}</span></div>
          @if($order->discount > 0)<div class="d-flex justify-content-between text-success"><span>Réduction</span><span>-{{ number_format($order->discount,3) }} TND</span></div>@endif
          <div class="d-flex justify-content-between fw-bold fs-5 mt-2 pt-2 border-top"><span>Total</span><span class="text-danger">{{ number_format($order->total,3) }} TND</span></div>
        </div>
      </div>
      <div class="card border-0 shadow mb-4">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Livraison à</h5>
          <p class="mb-1">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
          <p class="mb-1 text-muted">{{ $order->shipping_address }}</p>
          <p class="mb-1 text-muted">{{ $order->shipping_city }}{{ $order->shipping_state ? ', '.$order->shipping_state : '' }}</p>
          <p class="mb-0 text-muted">Tél: {{ $order->shipping_phone }}</p>
        </div>
      </div>
      <div class="d-flex gap-3 justify-content-center">
        <a href="{{ route('account.orders') }}" class="btn btn-outline-danger"><i class="fas fa-list me-1"></i>Mes commandes</a>
        <a href="{{ route('home') }}" class="btn btn-danger"><i class="fas fa-home me-1"></i>Retour à l'accueil</a>
        <a href="https://wa.me/21623136136?text=Bonjour, je viens de passer la commande {{ $order->order_number }}" target="_blank" class="btn btn-success"><i class="fab fa-whatsapp me-1"></i>Contacter sur WhatsApp</a>
      </div>
    </div>
  </div>
</div>
@endsection
