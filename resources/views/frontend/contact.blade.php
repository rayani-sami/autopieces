@extends('layouts.app')
@section('title','Contact - AutoPart')
@section('content')
<div class="container py-5">
  <div class="row g-4">
    <div class="col-md-6">
      <h1 class="fw-bold mb-4">Nous contacter</h1>
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="mb-3"><label class="fw-semibold small">Nom *</label><input type="text" name="name" class="form-control" required value="{{ old('name') }}"></div>
            <div class="mb-3"><label class="fw-semibold small">Email *</label><input type="email" name="email" class="form-control" required value="{{ old('email') }}"></div>
            <div class="mb-3"><label class="fw-semibold small">Sujet *</label><input type="text" name="subject" class="form-control" required value="{{ old('subject') }}"></div>
            <div class="mb-3"><label class="fw-semibold small">Message *</label><textarea name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea></div>
            <button type="submit" class="btn btn-danger w-100">Envoyer <i class="fas fa-paper-plane ms-1"></i></button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <h2 class="fw-bold mb-4">Nos coordonnées</h2>
      <div class="mb-3 d-flex gap-3"><i class="fas fa-map-marker-alt fa-lg text-danger mt-1"></i><div><strong>Adresse</strong><br>Bengardene<br>Mednine, Tunisie</div></div>
      <div class="mb-3 d-flex gap-3"><i class="fas fa-phone fa-lg text-success mt-1"></i><div><strong>Téléphone</strong><br>+216 28 878 286</div></div>
      <div class="mb-3 d-flex gap-3"><i class="fas fa-envelope fa-lg text-warning mt-1"></i><div><strong>Email</strong><br>autopart.tunisia@gmail.com</div></div>
      <div class="mb-3 d-flex gap-3"><i class="fas fa-clock fa-lg text-info mt-1"></i><div><strong>Horaires</strong><br>Lun-Ven: 8h30 à 17h00<br>Sam: 8h à 12h</div></div>
      <a href="https://wa.me/21628878286" target="_blank" class="btn btn-success btn-lg w-100 mt-2"><i class="fab fa-whatsapp me-2"></i>Discuter sur WhatsApp</a>
    </div>
  </div>
</div>
@endsection
