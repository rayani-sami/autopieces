@extends('layouts.app')
@section('title','Mot de passe oublié - AutoPart')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card border-0 shadow">
        <div class="card-body p-4">
          <h4 class="fw-bold text-center mb-3">Mot de passe oublié</h4>
          <p class="text-muted text-center small mb-4">Saisissez votre email pour recevoir un lien de réinitialisation.</p>
          @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
          <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3"><label class="fw-semibold small">Email</label><input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required><div class="invalid-feedback">{{ $errors->first('email') }}</div></div>
            <button type="submit" class="btn btn-danger w-100">Envoyer le lien</button>
          </form>
          <div class="text-center mt-3"><a href="{{ route('login') }}" class="text-muted small">← Retour à la connexion</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
