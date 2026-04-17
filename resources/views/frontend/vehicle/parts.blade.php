@extends('layouts.app')
@section('title', $make->name . ' ' . $model->name . ' - Pièces - AutoPart')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
      <li class="breadcrumb-item"><a href="{{ route('vehicle.models', $make->slug) }}">{{ $make->name }}</a></li>
      <li class="breadcrumb-item"><a href="{{ route('vehicle.engines', [$make->slug, $model->slug]) }}">{{ $model->name }}</a></li>
      <li class="breadcrumb-item active">Pièces</li>
    </ol>
  </nav>

  <div class="alert alert-success border-success mb-4">
    <div class="d-flex align-items-center">
      <i class="fas fa-car fa-2x text-success me-3"></i>
      <div>
        <h5 class="mb-0 fw-bold">{{ $make->name }} {{ $model->name }}</h5>
        <div class="text-muted">{{ $engine->full_name }}
          @if($engine->year_from) · {{ $engine->year_from }}{{ $engine->year_to ? '-'.$engine->year_to : '+' }}@endif
        </div>
      </div>
    </div>
  </div>

  <h1 class="fw-bold mb-4">Catégories de pièces disponibles</h1>
  <div class="row g-3">
    @foreach($categories as $cat)
    <div class="col-6 col-md-4 col-lg-3">
      <a href="{{ route('vehicle.category.parts', [$make->slug, $model->slug, $engine->slug, $cat->slug]) }}" class="card text-decoration-none text-dark border-0 shadow-sm h-100 category-card text-center">
        <div class="card-body p-3">
          @if($cat->image)<img src="{{ Storage::url($cat->image) }}" alt="{{ $cat->name }}" class="mb-2" style="height:50px;object-fit:contain">@else<i class="fas fa-cog fa-2x text-danger mb-2"></i>@endif
          <div class="fw-semibold small">{{ $cat->name }}</div>
        </div>
      </a>
    </div>
    @endforeach
  </div>

  @if($featuredProducts->count())
  <div class="mt-5">
    <h4 class="fw-bold mb-3">Pièces populaires pour ce véhicule</h4>
    <div class="row g-3">
      @foreach($featuredProducts as $product) <div class="col-6 col-md-3">@include('components.product-card', compact('product'))</div> @endforeach
    </div>
  </div>
  @endif
</div>
@endsection
