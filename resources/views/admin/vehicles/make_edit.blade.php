@extends('layouts.admin')
@section('page-title','Modifier: '.$make->name)
@section('content')
<div class="col-md-5">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form action="{{ route('admin.marques.update', $make) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="fw-semibold small">Nom *</label>
          <input type="text" name="name" class="form-control" value="{{ $make->name }}" required>
        </div>
        <div class="mb-3">
          <label class="fw-semibold small">Logo</label>
          @if($make->logo)
            <div class="mb-1"><img src="{{ Storage::url($make->logo) }}" style="height:30px;object-fit:contain"></div>
          @endif
          <input type="file" name="logo" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
          <label class="fw-semibold small">Ordre</label>
          <input type="number" name="sort_order" class="form-control" value="{{ $make->sort_order }}">
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ $make->is_active ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Actif</label>
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-danger">Enregistrer</button>
          <a href="{{ route('admin.marques.index') }}" class="btn btn-outline-secondary">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
