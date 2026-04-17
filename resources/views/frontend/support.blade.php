@extends('layouts.app')
@section('title','Support - AutoPart')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1 class="fw-bold mb-4">Support & Contact</h1>
      <div class="row g-4 mb-5">
        <div class="col-md-4 text-center"><a href="tel:+21623136136" class="text-decoration-none"><div class="py-4"><i class="fas fa-phone fa-3x text-success mb-3"></i><h5>Téléphone</h5><p class="text-muted">+216 23 136 136</p><p class="text-muted small">Lun-Ven 8h30-17h</p></div></a></div>
        <div class="col-md-4 text-center"><a href="https://wa.me/21623136136" target="_blank" class="text-decoration-none"><div class="py-4"><i class="fab fa-whatsapp fa-3x text-success mb-3"></i><h5>WhatsApp</h5><p class="text-muted">23 136 136</p><p class="text-muted small">Réponse rapide</p></div></a></div>
        <div class="col-md-4 text-center"><a href="mailto:autopart.tunisia@gmail.com" class="text-decoration-none"><div class="py-4"><i class="fas fa-envelope fa-3x text-danger mb-3"></i><h5>Email</h5><p class="text-muted small">autopart.tunisia@gmail.com</p></div></a></div>
      </div>
    </div>
  </div>
</div>
@endsection
