@extends('layouts.app')
@section('title','Commander - AutoPart')
@section('content')
<div class="container py-4">
  <h1 class="fw-bold mb-4"><i class="fas fa-credit-card text-danger me-2"></i>Finaliser ma commande</h1>
  <div class="row g-4">
    <div class="col-lg-8">
      <form action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body">
            <h5 class="fw-bold mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i>Adresse de livraison</h5>
            @if($user->addresses->count())
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Choisir une adresse enregistrée</label>
              @foreach($user->addresses as $addr)
              <div class="form-check mb-2 p-3 border rounded {{ $addr->is_default?'border-success bg-success-subtle':'' }}">
                <input class="form-check-input" type="radio" name="saved_address" value="{{ $addr->id }}" {{ $addr->is_default?'checked':'' }} onchange="fillAddress({{ json_encode($addr) }})">
                <label class="form-check-label">
                  <strong>{{ $addr->label }}</strong> - {{ $addr->first_name }} {{ $addr->last_name }}, {{ $addr->address_line1 }}, {{ $addr->city }}
                </label>
              </div>
              @endforeach
            </div>
            @endif
            <div class="row g-3">
              <div class="col-md-6"><label class="fw-semibold small">Prénom *</label><input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required></div>
              <div class="col-md-6"><label class="fw-semibold small">Nom *</label><input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required></div>
              <div class="col-md-6"><label class="fw-semibold small">Téléphone *</label><input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required></div>
              <div class="col-md-6"><label class="fw-semibold small">Gouvernorat *</label>
                <select name="state" class="form-select">
                  @foreach(['Tunis','Ariana','Ben Arous','Manouba','Nabeul','Zaghouan','Bizerte','Béja','Jendouba','Kef','Siliana','Kairouan','Kasserine','Sidi Bouzid','Sousse','Monastir','Mahdia','Sfax','Gafsa','Tozeur','Kébili','Gabès','Médenine','Tataouine'] as $gov)
                  <option>{{ $gov }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12"><label class="fw-semibold small">Ville *</label><input type="text" name="city" class="form-control" required></div>
              <div class="col-12"><label class="fw-semibold small">Adresse *</label><input type="text" name="address" class="form-control" required></div>
              <div class="col-12"><label class="fw-semibold small">Notes (optionnel)</label><textarea name="notes" class="form-control" rows="2" placeholder="Instructions de livraison..."></textarea></div>
            </div>
          </div>
        </div>

        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body">
            <h5 class="fw-bold mb-3"><i class="fas fa-money-bill-wave text-danger me-2"></i>Mode de paiement</h5>
            <div class="form-check p-3 border rounded mb-2">
              <input class="form-check-input" type="radio" name="payment_method" value="cash_on_delivery" id="cod" checked>
              <label class="form-check-label" for="cod"><i class="fas fa-money-bill text-success me-2"></i><strong>Paiement à la livraison</strong><br><small class="text-muted">Payez en espèces à la réception de votre colis</small></label>
            </div>
            <div class="form-check p-3 border rounded">
              <input class="form-check-input" type="radio" name="payment_method" value="bank_transfer" id="bank">
              <label class="form-check-label" for="bank"><i class="fas fa-university text-primary me-2"></i><strong>Virement bancaire</strong><br><small class="text-muted">Virement avant expédition</small></label>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-danger btn-lg w-100 py-3 fw-bold"><i class="fas fa-check-circle me-2"></i>Confirmer ma commande</button>
      </form>
    </div>
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm sticky-top" style="top:80px">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Récapitulatif</h5>
          @foreach($cart->items as $item)
          <div class="d-flex justify-content-between mb-2 small">
            <span>{{ Str::limit($item->product->name,30) }} × {{ $item->quantity }}</span>
            <span>{{ number_format($item->subtotal,3) }}</span>
          </div>
          @endforeach
          <hr>
          <div class="d-flex justify-content-between mb-1"><span>Sous-total</span><span>{{ number_format($subtotal,3) }} TND</span></div>
          @if($discount > 0)<div class="d-flex justify-content-between mb-1 text-success"><span>Réduction</span><span>-{{ number_format($discount,3) }} TND</span></div>@endif
          <div class="d-flex justify-content-between mb-2"><span>Livraison</span><span>{{ $shippingCost > 0 ? number_format($shippingCost,3).' TND' : 'Gratuite' }}</span></div>
          <hr>
          <div class="d-flex justify-content-between fw-bold fs-5"><span>Total</span><span class="text-danger">{{ number_format($subtotal - $discount + $shippingCost,3) }} TND</span></div>
          @if($subtotal >= 200)<div class="text-success small mt-1"><i class="fas fa-truck me-1"></i>Livraison gratuite !</div>@else<div class="text-muted small mt-1">Livraison gratuite dès 200 TND</div>@endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
