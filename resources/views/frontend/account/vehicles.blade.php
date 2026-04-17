@extends('layouts.app')
@section('title','Mes véhicules - AutoPart')
@section('content')
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mes véhicules</h1>
  <div class="row g-3">
    @foreach($vehicles as $vehicle)
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold">{{ $vehicle->label ?: $vehicle->engine->carModel->make->name.' '.$vehicle->engine->carModel->name }}</h6>
          <div class="text-muted small">{{ $vehicle->engine->full_name }}</div>
          @if($vehicle->plate)<div class="badge bg-light text-dark border mt-1">{{ $vehicle->plate }}</div>@endif
          <div class="mt-3 d-flex gap-2">
            <a href="{{ route('vehicle.parts',[$vehicle->engine->carModel->make->slug,$vehicle->engine->carModel->slug,$vehicle->engine->slug]) }}" class="btn btn-danger btn-sm">Voir les pièces</a>
            <form action="{{ route('account.vehicles.delete',$vehicle) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button></form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
