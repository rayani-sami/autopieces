@extends('layouts.app')
@section('title','Mon profil - AutoPart')
@section('content')
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mon profil</h1>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Informations personnelles</h5>
          <form action="{{ route('account.profile.update') }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
              <div class="col-md-6"><label class="fw-semibold small">Prénom</label><input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required></div>
              <div class="col-md-6"><label class="fw-semibold small">Nom</label><input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required></div>
              <div class="col-12"><label class="fw-semibold small">Email</label><input type="email" name="email" class="form-control" value="{{ $user->email }}" required></div>
              <div class="col-12"><label class="fw-semibold small">Téléphone</label><input type="text" name="phone" class="form-control" value="{{ $user->phone }}"></div>
            </div>
            <button type="submit" class="btn btn-danger mt-3">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Changer le mot de passe</h5>
          <form action="{{ route('account.profile.password') }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3"><label class="fw-semibold small">Mot de passe actuel</label><input type="password" name="current_password" class="form-control" required></div>
            <div class="mb-3"><label class="fw-semibold small">Nouveau mot de passe</label><input type="password" name="password" class="form-control" required></div>
            <div class="mb-3"><label class="fw-semibold small">Confirmer</label><input type="password" name="password_confirmation" class="form-control" required></div>
            <button type="submit" class="btn btn-danger">Modifier</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
