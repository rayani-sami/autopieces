@extends('layouts.admin')
@section('page-title','Produits')
@section('content')
<div class="d-flex justify-content-between mb-3">
  <a href="{{ route('admin.produits.create') }}" class="btn btn-danger"><i class="fas fa-plus me-1"></i>Nouveau produit</a>
  <form method="GET" class="d-flex gap-2">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Nom, référence..." value="{{ request('search') }}">
    <select name="category" class="form-select form-select-sm" style="width:160px">
      <option value="">Catégorie</option>
      @foreach($categories as $c)<option value="{{ $c->id }}" {{ request('category')==$c->id?'selected':'' }}>{{ $c->name }}</option>@endforeach
    </select>
    <button type="submit" class="btn btn-outline-secondary btn-sm">Filtrer</button>
  </form>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>Image</th><th>Nom</th><th>Catégorie</th><th>Réf.</th><th>Prix</th><th>Stock</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td><img src="{{ $product->thumbnail ? Storage::url($product->thumbnail) : '' }}" onerror="this.src=''" style="width:45px;height:45px;object-fit:contain;background:#f8f9fa" class="rounded"></td>
          <td><div class="fw-semibold small">{{ Str::limit($product->name,40) }}</div><div class="text-muted" style="font-size:11px">{{ $product->brand }}</div></td>
          <td class="small">{{ $product->category->name }}</td>
          <td class="small text-muted">{{ $product->reference }}</td>
          <td class="fw-bold small">{{ number_format($product->price,3) }}</td>
          <td><span class="badge bg-{{ $product->stock>10?'success':($product->stock>0?'warning':'danger') }}">{{ $product->stock }}</span></td>
          <td>@if($product->trashed())<span class="badge bg-secondary">Archivé</span>@elseif($product->is_active)<span class="badge bg-success">Actif</span>@else<span class="badge bg-warning">Inactif</span>@endif</td>
          <td><a href="{{ route('admin.produits.edit',$product) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3">{{ $products->withQueryString()->links() }}</div>
@endsection
