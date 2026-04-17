@extends('layouts.app')
@section('content')

<!-- Hero Slider -->
@if($banners->count())
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach($banners as $i=>$banner)
    <div class="carousel-item {{ $i===0?'active':'' }}">
      <img src="{{ Storage::url($banner->image) }}" class="d-block w-100" style="height:500px;object-fit:cover" alt="{{ $banner->title }}">
      @if($banner->title)
      <div class="carousel-caption d-none d-md-block">
        <h1 class="display-4 fw-bold">{{ $banner->title }}</h1>
        @if($banner->subtitle)<p class="lead">{{ $banner->subtitle }}</p>@endif
        @if($banner->link)<a href="{{ $banner->link }}" class="btn btn-danger btn-lg">{{ $banner->button_text ?? 'Voir' }}</a>@endif
      </div>
      @endif
    </div>
    @endforeach
  </div>
  @if($banners->count()>1)
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
  @endif
</div>
@else
<!-- Default hero -->
<div class="hero-default bg-danger text-white py-5">
  <div class="container text-center py-4">
    <h1 class="display-4 fw-bold mb-3">Vos pièces auto sur AutoPart.tn</h1>
    <p class="lead mb-4">Sélectionnez votre véhicule et trouvez les pièces compatibles</p>
  </div>
</div>
@endif

<!-- Vehicle Search Section -->
<div class="container py-4">
  <div class="card shadow-sm border-0 bg-light">
    <div class="card-body p-4">
      <h3 class="fw-bold mb-4 text-center"><i class="fas fa-car text-danger me-2"></i>Sélectionnez votre véhicule</h3>
      <div class="row g-3">
        <div class="col-md-6">
          <h5 class="fw-semibold mb-3">Recherche par immatriculation</h5>
          <form action="{{ route('search.registration') }}" method="POST">
            @csrf
            <div class="input-group input-group-lg">
              <select name="plate_type" class="form-select flex-grow-0" style="width:90px">
                <option>TU</option><option>RS</option>
              </select>
              <input type="text" name="plate" class="form-control" placeholder="Numéro d'immatriculation" required>
              <button class="btn btn-danger px-4" type="submit"><i class="fas fa-search me-1"></i>Rechercher</button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <h5 class="fw-semibold mb-3">Ou par constructeur</h5>
          <div class="row g-2">
            @foreach($makes->take(12) as $make)
            <div class="col-4 col-md-3">
              <a href="{{ route('vehicle.models', $make->slug) }}" class="btn btn-outline-secondary btn-sm w-100 py-2">
                @if($make->logo)<img src="{{ Storage::url($make->logo) }}" alt="{{ $make->name }}" height="20" class="me-1">@endif
                {{ $make->name }}
              </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Categories Grid -->
<div class="container pb-4">
  <h2 class="fw-bold mb-4">Catalogue pièces automobiles</h2>
  <div class="row g-3">
    @foreach($rootCategories as $cat)
    <div class="col-6 col-md-4 col-lg-2">
      <a href="{{ route('catalog.category', $cat->slug) }}" class="card text-center text-decoration-none border-0 shadow-sm h-100 category-card">
        <div class="card-body p-3">
          @if($cat->image)
            <img src="{{ Storage::url($cat->image) }}" alt="{{ $cat->name }}" class="mb-2" style="height:60px;object-fit:contain">
          @else
            <div class="category-icon mb-2"><i class="fas fa-cog fa-2x text-danger"></i></div>
          @endif
          <div class="fw-semibold small text-dark">{{ $cat->name }}</div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>

<!-- Featured Products -->
@if($featuredProducts->count())
<div class="container pb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Produits populaires</h2>
    <a href="{{ route('search') }}" class="btn btn-outline-danger btn-sm">Voir tout</a>
  </div>
  <div class="row g-3">
    @foreach($featuredProducts as $product)
    <div class="col-6 col-md-4 col-lg-3">
      @include('components.product-card', ['product' => $product])
    </div>
    @endforeach
  </div>
</div>
@endif

<!-- Makes brands strip -->
<div class="bg-light py-4 mb-4">
  <div class="container">
    <h3 class="fw-bold text-center mb-4">Constructeurs automobiles</h3>
    <div class="row g-2 justify-content-center">
      @foreach($makes as $make)
      <div class="col-auto">
        <a href="{{ route('vehicle.models', $make->slug) }}" class="btn btn-white border shadow-sm px-3 py-2 text-dark">{{ $make->name }}</a>
      </div>
      @endforeach
    </div>
  </div>
</div>

<!-- Why us -->
<div class="container pb-5">
  <div class="row g-4 text-center">
    <div class="col-md-3"><div class="py-3"><i class="fas fa-shipping-fast fa-2x text-danger mb-3"></i><h5 class="fw-bold">Livraison rapide</h5><p class="text-muted small">Partout en Tunisie en 24-48h</p></div></div>
    <div class="col-md-3"><div class="py-3"><i class="fas fa-shield-alt fa-2x text-success mb-3"></i><h5 class="fw-bold">Pièces garanties</h5><p class="text-muted small">Qualité origine vérifiée</p></div></div>
    <div class="col-md-3"><div class="py-3"><i class="fas fa-headset fa-2x text-primary mb-3"></i><h5 class="fw-bold">Support expert</h5><p class="text-muted small">Nos conseillers vous guident</p></div></div>
    <div class="col-md-3"><div class="py-3"><i class="fas fa-undo fa-2x text-warning mb-3"></i><h5 class="fw-bold">Retours faciles</h5><p class="text-muted small">30 jours pour changer d'avis</p></div></div>
  </div>
</div>
@endsection
