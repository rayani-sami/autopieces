@extends('layouts.admin')
@section('page-title', $product->name)
@section('content')
<div class="row g-4">
  <div class="col-md-5">
    <div class="card border-0 shadow-sm">
      <div class="card-body text-center p-4" style="background:#f8f9fa;min-height:250px;display:flex;align-items:center;justify-content:center">
        @if($product->thumbnail)
          <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" style="max-height:230px;max-width:100%;object-fit:contain">
        @else
          <i class="fas fa-image fa-4x text-muted"></i>
        @endif
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div>
            <span class="badge bg-secondary mb-1">{{ $product->category->name }}</span>
            <h4 class="fw-bold">{{ $product->name }}</h4>
          </div>
          <a href="{{ route('admin.produits.edit', $product) }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-edit me-1"></i>Modifier</a>
        </div>
        <table class="table table-sm">
          <tr><th class="text-muted w-40" style="width:40%">Référence</th><td>{{ $product->reference ?: '-' }}</td></tr>
          <tr><th class="text-muted">OEM</th><td>{{ $product->oem_reference ?: '-' }}</td></tr>
          <tr><th class="text-muted">Marque pièce</th><td>{{ $product->brand ?: '-' }}</td></tr>
          <tr><th class="text-muted">Prix</th><td class="fw-bold text-danger">{{ number_format($product->price, 3) }} TND</td></tr>
          <tr><th class="text-muted">Ancien prix</th><td>{{ $product->price_old ? number_format($product->price_old, 3).' TND' : '-' }}</td></tr>
          <tr><th class="text-muted">Stock</th><td><span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">{{ $product->stock }}</span></td></tr>
          <tr><th class="text-muted">Vues</th><td>{{ $product->views }}</td></tr>
          <tr><th class="text-muted">Statut</th><td><span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">{{ $product->is_active ? 'Actif' : 'Inactif' }}</span>{{ $product->is_featured ? ' <span class="badge bg-warning">Vedette</span>' : '' }}{{ $product->is_new ? ' <span class="badge bg-info">Nouveau</span>' : '' }}</td></tr>
        </table>
        @if($product->description)
          <div class="mt-3"><h6 class="fw-bold">Description</h6><p class="text-muted small">{{ $product->description }}</p></div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
