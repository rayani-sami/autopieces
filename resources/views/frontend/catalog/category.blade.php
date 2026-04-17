@extends('layouts.app')
@section('title', $category->name . ' - AutoPart')
@section('content')
<div class="container py-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
      @if($category->parent)
        <li class="breadcrumb-item"><a href="{{ route('catalog.category', $category->parent->slug) }}">{{ $category->parent->name }}</a></li>
      @endif
      <li class="breadcrumb-item active">{{ $category->name }}</li>
    </ol>
  </nav>

  <div class="row g-4">
    <!-- Sidebar Filters -->
    <div class="col-lg-3">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3"><i class="fas fa-filter text-danger me-2"></i>Filtres</h5>
          <form method="GET">
            @if($engine)
              <div class="alert alert-success-subtle border-success-subtle p-2 mb-3 small">
                <i class="fas fa-car text-success me-1"></i>
                {{ $engine->carModel->make->name }} {{ $engine->carModel->name }}
              </div>
            @endif
            @if($brands->count())
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Marque de pièce</label>
              @foreach($brands as $brand)
              <div class="form-check">
                <input class="form-check-input" type="radio" name="brand" value="{{ $brand }}" id="b{{ Str::slug($brand) }}" {{ request('brand')==$brand?'checked':'' }}>
                <label class="form-check-label small" for="b{{ Str::slug($brand) }}">{{ $brand }}</label>
              </div>
              @endforeach
            </div>
            @endif
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Prix (TND)</label>
              <div class="row g-1">
                <div class="col-6"><input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}"></div>
                <div class="col-6"><input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}"></div>
              </div>
            </div>
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Trier par</label>
              <select name="sort" class="form-select form-select-sm">
                <option value="default" {{ request('sort','default')==='default'?'selected':'' }}>Par défaut</option>
                <option value="price_asc" {{ request('sort')==='price_asc'?'selected':'' }}>Prix croissant</option>
                <option value="price_desc" {{ request('sort')==='price_desc'?'selected':'' }}>Prix décroissant</option>
                <option value="newest" {{ request('sort')==='newest'?'selected':'' }}>Plus récents</option>
              </select>
            </div>
            <button type="submit" class="btn btn-danger btn-sm w-100">Appliquer</button>
            <a href="{{ route('catalog.category', $category->slug) }}" class="btn btn-outline-secondary btn-sm w-100 mt-1">Réinitialiser</a>
          </form>
        </div>
      </div>
      @if($category->children->count())
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold mb-2">Sous-catégories</h6>
          @foreach($category->children as $child)
            <a href="{{ route('catalog.category', $child->slug) }}" class="d-block text-decoration-none text-dark py-1 border-bottom small hover-link">{{ $child->name }}</a>
          @endforeach
        </div>
      </div>
      @endif
    </div>

    <!-- Products Grid -->
    <div class="col-lg-9">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 fw-bold mb-0">{{ $category->name }}</h1>
        <span class="text-muted small">{{ $products->total() }} produits trouvés</span>
      </div>
      @if(!$engine)
      <div class="alert alert-info-subtle border-info-subtle small mb-3">
        <i class="fas fa-info-circle me-1"></i>Sélectionnez votre véhicule pour voir uniquement les pièces compatibles.
      </div>
      @endif
      @if($products->count())
      <div class="row g-3">
        @foreach($products as $product)
        <div class="col-6 col-md-4">@include('components.product-card', compact('product'))</div>
        @endforeach
      </div>
      <div class="mt-4">{{ $products->links() }}</div>
      @else
      <div class="text-center py-5 text-muted">
        <i class="fas fa-search fa-3x mb-3"></i>
        <h5>Aucun produit trouvé</h5>
        <p>Essayez de modifier vos filtres ou <a href="{{ route('catalog.category', $category->slug) }}">réinitialisez</a> la recherche.</p>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
