@extends('layouts.admin')
@section('page-title','Modifier: '.$user->full_name)
@section('content')
<div class="col-md-6">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form action="{{ route('admin.utilisateurs.update', $user) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
          <div class="col-6">
            <label class="fw-semibold small">Prénom *</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $user->first_name }}" required>
            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-6">
            <label class="fw-semibold small">Nom *</label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $user->last_name }}" required>
          </div>
          <div class="col-12">
            <label class="fw-semibold small">Email *</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-12">
            <label class="fw-semibold small">Téléphone</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
          </div>
          <div class="col-12">
            <label class="fw-semibold small">Rôle</label>
            <select name="role" class="form-select">
              <option value="client" {{ $user->hasRole('client') ? 'selected' : '' }}>Client</option>
              <option value="manager" {{ $user->hasRole('manager') ? 'selected' : '' }}>Manager</option>
              <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
            </select>
          </div>
          <div class="col-12">
            <label class="fw-semibold small">Nouveau mot de passe <span class="text-muted">(laisser vide pour ne pas changer)</span></label>
            <input type="password" name="new_password" class="form-control" autocomplete="new-password">
          </div>
        </div>
        <div class="d-flex gap-2 mt-3">
          <button type="submit" class="btn btn-danger">Enregistrer</button>
          <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-outline-secondary">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
