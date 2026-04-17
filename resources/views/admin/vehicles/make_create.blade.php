@extends('layouts.admin')
@section('page-title','Nouvelle marque')
@section('content')
<div class="col-md-5">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form action="{{ route('admin.marques.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label class="fw-semibold small">Nom de la marque *</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Ex: Renault, Peugeot...">
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="fw-semibold small">Logo</label>
          <input type="file" name="logo" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
          <label class="fw-semibold small">Ordre d'affichage</label>
          <input type="number" name="sort_order" class="form-control" value="0">
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
          <label class="form-check-label" for="is_active">Actif</label>
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-danger">Créer la marque</button>
          <a href="{{ route('admin.marques.index') }}" class="btn btn-outline-secondary">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
