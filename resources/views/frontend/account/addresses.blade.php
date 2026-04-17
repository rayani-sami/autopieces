@extends('layouts.app')
@section('title','Mes adresses - AutoPart')
@section('content')
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mes adresses</h1>
  <div class="row g-4">
    @foreach($addresses as $addr)
    <div class="col-md-6">
      <div class="card border-0 shadow-sm {{ $addr->is_default?'border-success':'' }}">
        <div class="card-body">
          @if($addr->is_default)<span class="badge bg-success mb-2">Adresse principale</span>@endif
          <h6 class="fw-bold">{{ $addr->label }}</h6>
          <p class="mb-1">{{ $addr->first_name }} {{ $addr->last_name }}</p>
          <p class="mb-1 text-muted small">{{ $addr->address_line1 }}</p>
          <p class="mb-1 text-muted small">{{ $addr->city }}{{ $addr->state?', '.$addr->state:'' }}</p>
          <p class="mb-0 text-muted small">Tél: {{ $addr->phone }}</p>
          <div class="mt-3 d-flex gap-2">
            <form action="{{ route('account.addresses.delete',$addr) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button></form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    <div class="col-md-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Ajouter une adresse</h5>
          <form action="{{ route('account.addresses.store') }}" method="POST">
            @csrf
            <div class="row g-2">
              <div class="col-12"><input type="text" name="label" class="form-control form-control-sm" placeholder="Label (Maison, Bureau...)" required></div>
              <div class="col-6"><input type="text" name="first_name" class="form-control form-control-sm" placeholder="Prénom" required></div>
              <div class="col-6"><input type="text" name="last_name" class="form-control form-control-sm" placeholder="Nom" required></div>
              <div class="col-12"><input type="text" name="phone" class="form-control form-control-sm" placeholder="Téléphone" required></div>
              <div class="col-12"><input type="text" name="address_line1" class="form-control form-control-sm" placeholder="Adresse" required></div>
              <div class="col-6"><input type="text" name="city" class="form-control form-control-sm" placeholder="Ville" required></div>
              <div class="col-6"><input type="text" name="state" class="form-control form-control-sm" placeholder="Gouvernorat"></div>
              <div class="col-12"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_default" value="1"><label class="form-check-label small">Adresse principale</label></div></div>
              <div class="col-12"><button type="submit" class="btn btn-danger btn-sm w-100">Ajouter</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
