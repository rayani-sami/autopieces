@extends('layouts.app')
@section('title','Réinitialiser le mot de passe - AutoPart')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card border-0 shadow">
        <div class="card-body p-4">
          <h4 class="fw-bold text-center mb-4">Nouveau mot de passe</h4>
          <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3"><label class="fw-semibold small">Email</label><input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required></div>
            <div class="mb-3"><label class="fw-semibold small">Nouveau mot de passe</label><input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required><div class="invalid-feedback">{{ $errors->first('password') }}</div></div>
            <div class="mb-3"><label class="fw-semibold small">Confirmer le mot de passe</label><input type="password" name="password_confirmation" class="form-control" required></div>
            <button type="submit" class="btn btn-danger w-100">Réinitialiser</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
