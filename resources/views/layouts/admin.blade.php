<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Admin') - AutoPart</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{background:#f4f6f9}
.sidebar{min-height:100vh;background:#1a1a2e;width:250px;position:fixed;top:0;left:0;z-index:100;overflow-y:auto}
.sidebar .nav-link{color:#adb5bd;border-radius:6px;margin:2px 8px;padding:8px 12px}
.sidebar .nav-link:hover,.sidebar .nav-link.active{background:#e74c3c;color:#fff}
.sidebar .nav-link i{width:20px}
.main-content{margin-left:250px;padding:20px}
.sidebar-brand{padding:20px;border-bottom:1px solid #2d2d44}
.nav-section{color:#6c757d;font-size:11px;font-weight:600;text-transform:uppercase;padding:12px 20px 4px}
@media(max-width:768px){.sidebar{transform:translateX(-100%)}.main-content{margin-left:0}}
</style>
</head>
<body>
<div class="sidebar">
  <div class="sidebar-brand">
    <a href="{{ route('home') }}" class="text-decoration-none"><span class="text-danger fw-bold fs-5">Auto</span><span class="text-white fw-bold fs-5">Part</span></a>
    <div class="text-muted small mt-1">Tableau de bord admin</div>
  </div>
  <nav class="pt-2">
    <div class="nav-section">Principal</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
    <div class="nav-section">Catalogue</div>
    <a href="{{ route('admin.produits.index') }}" class="nav-link {{ request()->routeIs('admin.produits.*') ? 'active' : '' }}"><i class="fas fa-box me-2"></i>Produits</a>
    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="fas fa-tags me-2"></i>Catégories</a>
    <div class="nav-section">Commandes</div>
    <a href="{{ route('admin.commandes.index') }}" class="nav-link {{ request()->routeIs('admin.commandes.*') ? 'active' : '' }}"><i class="fas fa-shopping-bag me-2"></i>Commandes</a>
    <div class="nav-section">Véhicules</div>
    <a href="{{ route('admin.marques.index') }}" class="nav-link {{ request()->routeIs('admin.marques.*') ? 'active' : '' }}"><i class="fas fa-car me-2"></i>Marques & Modèles</a>
    <div class="nav-section">Utilisateurs</div>
    <a href="{{ route('admin.utilisateurs.index') }}" class="nav-link {{ request()->routeIs('admin.utilisateurs.*') ? 'active' : '' }}"><i class="fas fa-users me-2"></i>Utilisateurs</a>
    <div class="nav-section">Paramètres</div>
    <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}"><i class="fas fa-percent me-2"></i>Coupons</a>
    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="fas fa-cog me-2"></i>Paramètres</a>
    <div class="nav-section">Navigation</div>
    <a href="{{ route('home') }}" class="nav-link" target="_blank"><i class="fas fa-external-link-alt me-2"></i>Voir le site</a>
    <form action="{{ route('logout') }}" method="POST" class="px-2 mt-2">@csrf<button class="btn btn-outline-danger btn-sm w-100"><i class="fas fa-sign-out-alt me-1"></i>Déconnexion</button></form>
  </nav>
</div>
<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">@yield('page-title','Dashboard')</h4>
    <div class="text-muted small">{{ auth()->user()->full_name }} <span class="badge bg-danger ms-1">{{ auth()->user()->getRoleNames()->first() }}</span></div>
  </div>
  @foreach(['success','error','warning'] as $type)
    @if(session($type))
      <div class="alert alert-{{ $type === 'error' ? 'danger' : $type }} alert-dismissible fade show">{{ session($type) }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
  @endforeach
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
  @endif
  @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
