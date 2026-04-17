@extends('layouts.app')
@section('title', $make->name . ' ' . $model->name . ' - Motorisations - AutoPart')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
      <li class="breadcrumb-item"><a href="{{ route('vehicle.models', $make->slug) }}">{{ $make->name }}</a></li>
      <li class="breadcrumb-item active">{{ $model->name }}</li>
    </ol>
  </nav>
  <h1 class="fw-bold mb-4">{{ $make->name }} {{ $model->name }} - Choisir la motorisation</h1>
  <div class="row g-3">
    @foreach($engines as $engine)
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('vehicle.parts', [$make->slug, $model->slug, $engine->slug]) }}" class="card text-decoration-none text-dark border-0 shadow-sm hover-card">
        <div class="card-body p-3">
          <div class="fw-semibold">{{ $engine->name }}</div>
          <div class="text-muted small">
            @if($engine->fuel_type)<span class="badge bg-{{ $engine->fuel_type==='diesel'?'dark':'primary' }} me-1">{{ ucfirst($engine->fuel_type) }}</span>@endif
            @if($engine->power_hp)<span>{{ $engine->power_hp }} ch</span>@endif
            @if($engine->engine_code)<span class="ms-1 text-muted">{{ $engine->engine_code }}</span>@endif
          </div>
          @if($engine->year_from)<div class="text-muted small mt-1">{{ $engine->year_from }}{{ $engine->year_to ? ' → '.$engine->year_to : '+' }}</div>@endif
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endsection
