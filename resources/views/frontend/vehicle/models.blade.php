@extends('layouts.app')
@section('title', $make->name . ' - Modèles - AutoPart')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
      <li class="breadcrumb-item active">{{ $make->name }}</li>
    </ol>
  </nav>
  <h1 class="fw-bold mb-4"><i class="fas fa-car text-danger me-2"></i>{{ $make->name }} - Choisir un modèle</h1>
  <div class="row g-3">
    @foreach($models as $model)
    <div class="col-6 col-md-4 col-lg-3">
      <a href="{{ route('vehicle.engines', [$make->slug, $model->slug]) }}" class="card text-decoration-none text-dark border-0 shadow-sm h-100 hover-card">
        <div class="card-body text-center p-3">
          @if($model->image)<img src="{{ Storage::url($model->image) }}" alt="{{ $model->name }}" class="mb-2" style="height:60px;object-fit:contain">@endif
          <div class="fw-semibold">{{ $model->name }}</div>
          @if($model->year_from)<div class="text-muted small">{{ $model->year_from }}{{ $model->year_to ? ' - '.$model->year_to : '+' }}</div>@endif
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endsection
