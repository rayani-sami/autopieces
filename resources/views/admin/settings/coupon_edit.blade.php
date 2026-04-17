@extends('layouts.admin')
@section('page-title','Modifier coupon')
@section('content')
<div class="col-md-6">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form action="{{ route('admin.coupons.update',$coupon) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3"><label class="fw-semibold small">Code</label><input type="text" name="code" class="form-control text-uppercase" value="{{ $coupon->code }}" required></div>
        <div class="mb-3"><label class="fw-semibold small">Type</label><select name="type" class="form-select"><option value="percentage" {{ $coupon->type==='percentage'?'selected':'' }}>Pourcentage</option><option value="fixed" {{ $coupon->type==='fixed'?'selected':'' }}>Montant fixe</option></select></div>
        <div class="mb-3"><label class="fw-semibold small">Valeur</label><input type="number" name="value" step="0.001" class="form-control" value="{{ $coupon->value }}" required></div>
        <div class="mb-3"><label class="fw-semibold small">Commande minimum</label><input type="number" name="min_order" step="0.001" class="form-control" value="{{ $coupon->min_order }}"></div>
        <div class="mb-3"><label class="fw-semibold small">Limite d'utilisation</label><input type="number" name="usage_limit" class="form-control" value="{{ $coupon->usage_limit }}"></div>
        <div class="mb-3"><label class="fw-semibold small">Expiration</label><input type="date" name="expires_at" class="form-control" value="{{ $coupon->expires_at?->format('Y-m-d') }}"></div>
        <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $coupon->is_active?'checked':'' }}><label class="form-check-label">Actif</label></div>
        <button type="submit" class="btn btn-danger w-100">Enregistrer</button>
      </form>
    </div>
  </div>
</div>
@endsection
