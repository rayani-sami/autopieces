@extends('layouts.app')
@section('title','Inscription - AutoPart')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card border-0 shadow">
        <div class="card-body p-4">
          <h4 class="fw-bold text-center mb-4">Créer un compte</h4>
          <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-6"><label class="fw-semibold small">Prénom *</label><input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required><div class="invalid-feedback">{{ $errors->first('first_name') }}</div></div>
              <div class="col-md-6"><label class="fw-semibold small">Nom *</label><input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required><div class="invalid-feedback">{{ $errors->first('last_name') }}</div></div>
              <div class="col-12"><label class="fw-semibold small">Email *</label><input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required><div class="invalid-feedback">{{ $errors->first('email') }}</div></div>
              <div class="col-12"><label class="fw-semibold small">Téléphone</label><input type="text" name="phone" class="form-control" value="{{ old('phone') }}"></div>
              <div class="col-12"><label class="fw-semibold small">Mot de passe *</label><input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required><div class="invalid-feedback">{{ $errors->first('password') }}</div></div>
              <div class="col-12"><label class="fw-semibold small">Confirmer le mot de passe *</label><input type="password" name="password_confirmation" class="form-control" required></div>
            </div>
            <button type="submit" class="btn btn-danger w-100 py-2 fw-bold mt-3">Créer mon compte</button>
          </form>
          <hr>
          <div class="text-center"><span class="text-muted small">Déjà un compte ?</span> <a href="{{ route('login') }}" class="text-danger fw-semibold">Se connecter</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
