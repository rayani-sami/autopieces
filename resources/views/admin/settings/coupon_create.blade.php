@extends('layouts.admin')
@section('page-title','Nouveau coupon')
@section('content')
<div class="col-md-6">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label class="fw-semibold small">Code *</label><input type="text" name="code" class="form-control text-uppercase" required placeholder="EX: PROMO20"></div>
        <div class="mb-3"><label class="fw-semibold small">Type *</label><select name="type" class="form-select"><option value="percentage">Pourcentage (%)</option><option value="fixed">Montant fixe (TND)</option></select></div>
        <div class="mb-3"><label class="fw-semibold small">Valeur *</label><input type="number" name="value" step="0.001" class="form-control" required></div>
        <div class="mb-3"><label class="fw-semibold small">Commande minimum (TND)</label><input type="number" name="min_order" step="0.001" class="form-control" value="0"></div>
        <div class="mb-3"><label class="fw-semibold small">Limite d'utilisation</label><input type="number" name="usage_limit" class="form-control" placeholder="Vide = illimité"></div>
        <div class="mb-3"><label class="fw-semibold small">Expiration</label><input type="date" name="expires_at" class="form-control"></div>
        <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Actif</label></div>
        <button type="submit" class="btn btn-danger w-100">Créer le coupon</button>
      </form>
    </div>
  </div>
</div>
@endsection
