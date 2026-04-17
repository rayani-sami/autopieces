@extends('layouts.app')
@section('title','Connexion - AutoPart')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card border-0 shadow">
        <div class="card-body p-4">
          <div class="text-center mb-4"><div class="logo-text"><span class="text-danger fw-bold fs-4">Auto</span><span class="text-dark fw-bold fs-4">Part</span></div></div>
          <h4 class="fw-bold text-center mb-4">Se connecter</h4>
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3"><label class="fw-semibold small">Email</label><input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required><div class="invalid-feedback">{{ $errors->first('email') }}</div></div>
            <div class="mb-3"><label class="fw-semibold small">Mot de passe</label><input type="password" name="password" class="form-control" required></div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check"><input class="form-check-input" type="checkbox" name="remember" id="remember"><label class="form-check-label small" for="remember">Se souvenir de moi</label></div>
              <a href="{{ route('password.request') }}" class="small text-danger">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">Se connecter</button>
          </form>
          <hr>
          <div class="text-center"><span class="text-muted small">Pas encore de compte ?</span> <a href="{{ route('register') }}" class="text-danger fw-semibold">Créer un compte</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
