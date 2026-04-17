@extends('layouts.app')
@section('title', $category->name . ' - ' . $make->name . ' ' . $model->name . ' - AutoPart')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
      <li class="breadcrumb-item"><a href="{{ route('vehicle.models', $make->slug) }}">{{ $make->name }}</a></li>
      <li class="breadcrumb-item"><a href="{{ route('vehicle.engines', [$make->slug, $model->slug]) }}">{{ $model->name }}</a></li>
      <li class="breadcrumb-item"><a href="{{ route('vehicle.parts', [$make->slug, $model->slug, $engine->slug]) }}">Pièces</a></li>
      <li class="breadcrumb-item active">{{ $category->name }}</li>
    </ol>
  </nav>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 fw-bold mb-0">{{ $category->name }} - {{ $make->name }} {{ $model->name }}</h1>
    <span class="text-muted">{{ $products->total() }} résultats</span>
  </div>
  @if($products->count())
  <div class="row g-3">
    @foreach($products as $product) <div class="col-6 col-md-4 col-lg-3">@include('components.product-card', compact('product'))</div> @endforeach
  </div>
  <div class="mt-4">{{ $products->links() }}</div>
  @else
  <div class="text-center py-5 text-muted"><i class="fas fa-search fa-3x mb-3"></i><h5>Aucune pièce trouvée pour ce véhicule</h5></div>
  @endif
</div>
@endsection
