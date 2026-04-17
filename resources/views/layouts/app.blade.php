<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', config('app.name', 'AutoPart') . ' - Pièces auto en ligne Tunisie')</title>
<meta name="description" content="@yield('description', 'Vente de pièces automobiles en ligne en Tunisie. Sélectionnez votre véhicule et trouvez les pièces compatibles.')">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('styles')
</head>
<body>

<!-- Top Bar -->
<div class="topbar bg-dark text-white py-1 small">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3">
      <span class="d-none d-md-inline"><i class="fas fa-map-marker-alt me-1 text-danger"></i>Bengarden, Mednine</span>
      <span><i class="fas fa-phone me-1 text-success"></i>+216 28 878 286</span>
      <span class="d-none d-lg-inline"><i class="fas fa-clock me-1 text-warning"></i>Lun-Ven 8h30-17h</span>
    </div>
    <div class="d-flex gap-3 align-items-center">
      @auth
        <a href="{{ route('account.index') }}" class="text-white text-decoration-none"><i class="fas fa-user me-1"></i>{{ auth()->user()->first_name }}</a>
        @if(auth()->user()->hasRole(['admin','manager']))
          <a href="{{ route('admin.dashboard') }}" class="text-warning text-decoration-none"><i class="fas fa-cog me-1"></i>Admin</a>
        @endif
        <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
          @csrf
          <button type="submit" class="btn btn-link text-white p-0 small text-decoration-none">Déconnexion</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="text-white text-decoration-none"><i class="fas fa-sign-in-alt me-1"></i>Connexion</a>
        <a href="{{ route('register') }}" class="text-white text-decoration-none d-none d-md-inline"><i class="fas fa-user-plus me-1"></i>Inscription</a>
      @endauth
    </div>
  </div>
</div>

<!-- Header -->
<header class="header bg-white border-bottom sticky-top">
  <div class="container py-3">
    <div class="row align-items-center g-2">
      <!-- Logo -->
      <div class="col-6 col-md-2">
        <a href="{{ route('home') }}" class="text-decoration-none">
          <div class="logo-text">
            <span class="text-danger fw-bold fs-4">Auto</span><span class="text-dark fw-bold fs-4">Part</span><span class="text-muted small">.tn</span>
          </div>
        </a>
      </div>
      <!-- Search -->
      <div class="col-12 col-md-7 order-3 order-md-2">
        <form action="{{ route('search') }}" method="GET" autocomplete="off">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Nom de pièce, référence, marque..." value="{{ request('q') }}" aria-label="Rechercher">
            <button class="btn btn-danger" type="submit"><i class="fas fa-search"></i></button>
          </div>
        </form>
      </div>
      <!-- Icons -->
      <div class="col-6 col-md-3 order-2 order-md-3 text-end d-flex align-items-center justify-content-end gap-2">
        <a href="{{ route('cart.index') }}" class="btn btn-outline-danger position-relative">
          <i class="fas fa-shopping-cart"></i>
          @if(($cartCount ?? 0) > 0)
            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill cart-count" style="font-size:10px">{{ $cartCount }}</span>
          @else
            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill cart-count d-none" style="font-size:10px">0</span>
          @endif
        </a>
        @auth
          <a href="{{ route('account.index') }}" class="btn btn-outline-secondary d-none d-md-inline-flex"><i class="fas fa-user"></i></a>
        @else
          <a href="{{ route('login') }}" class="btn btn-outline-secondary d-none d-md-inline-flex"><i class="fas fa-user"></i></a>
        @endauth
      </div>
    </div>
  </div>

  <!-- Vehicle bar -->
  @if(isset($selectedEngine) && $selectedEngine)
  <div class="vehicle-bar bg-success-subtle py-2">
    <div class="container d-flex align-items-center justify-content-between">
      <span class="text-success fw-semibold small">
        <i class="fas fa-check-circle me-1"></i>
        Véhicule sélectionné:
        <strong>{{ $selectedEngine->carModel->make->name }} {{ $selectedEngine->carModel->name }}</strong>
        — {{ $selectedEngine->full_name }}
      </span>
      <form action="{{ route('vehicle.clear') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-danger py-0">
          <i class="fas fa-times me-1"></i>Changer
        </button>
      </form>
    </div>
  </div>
  @endif

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-white border-top py-0">
    <div class="container">
      <button class="navbar-toggler border-0 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav me-auto py-1">
          <!-- Catalogue dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link fw-semibold dropdown-toggle py-3" href="#" id="catalogDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-th-large me-1 text-danger"></i>Catalogue pièces
            </a>
            <ul class="dropdown-menu mega-menu p-0 border-0" aria-labelledby="catalogDropdown">
              <li>
                <div class="p-4">
                  <div class="row g-3">
                    @foreach($globalCategories ?? [] as $cat)
                    <div class="col-md-3">
                      <a href="{{ route('catalog.category', $cat->slug) }}" class="fw-semibold text-danger text-decoration-none d-block mb-2 small">
                        <i class="fas fa-chevron-right me-1" style="font-size:10px"></i>{{ $cat->name }}
                      </a>
                      @foreach($cat->children->take(6) as $child)
                        <a href="{{ route('catalog.category', $child->slug) }}" class="hover-link d-block text-dark text-decoration-none small py-1">
                          {{ $child->name }}
                        </a>
                      @endforeach
                    </div>
                    @endforeach
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link py-3" href="{{ route('contact') }}"><i class="fas fa-headset me-1"></i>Contact</a>
          </li>
        </ul>

        <!-- Vehicle selector -->
        <div class="d-flex align-items-center py-1">
          <div class="dropdown">
            <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-car me-1"></i>
              @if(isset($selectedEngine) && $selectedEngine)
                Changer véhicule
              @else
                Sélectionner mon véhicule
              @endif
            </button>
            <div class="dropdown-menu dropdown-menu-end p-3 border-0 shadow" style="min-width:320px;border-radius:12px">
              <h6 class="fw-bold mb-2 small text-uppercase text-muted">Par immatriculation</h6>
              <form action="{{ route('search.registration') }}" method="POST" class="mb-3">
                @csrf
                <div class="input-group input-group-sm">
                  <select name="plate_type" class="form-select" style="max-width:65px">
                    <option value="TU">TU</option>
                    <option value="RS">RS</option>
                  </select>
                  <input type="text" name="plate" class="form-control" placeholder="123 4567" pattern="[0-9]+" required>
                  <button class="btn btn-danger" type="submit"><i class="fas fa-search"></i></button>
                </div>
              </form>
              <h6 class="fw-bold mb-2 small text-uppercase text-muted">Par constructeur</h6>
              <div class="row g-1" style="max-height:220px;overflow-y:auto">
                @foreach($globalMakes ?? [] as $make)
                <div class="col-6">
                  <a href="{{ route('vehicle.models', $make->slug) }}" class="btn btn-outline-secondary btn-sm w-100 text-start text-truncate small py-1">
                    {{ $make->name }}
                  </a>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- Flash messages -->
<div class="container mt-2" id="flash-container">
  @foreach(['success','error','warning','info'] as $type)
    @if(session($type))
      <div class="alert alert-{{ $type === 'error' ? 'danger' : $type }} alert-dismissible fade show" role="alert">
        <i class="fas fa-{{ $type === 'success' ? 'check-circle' : ($type === 'error' ? 'exclamation-circle' : 'info-circle') }} me-2"></i>
        {{ session($type) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
      </div>
    @endif
  @endforeach
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fas fa-exclamation-triangle me-2"></i>
      <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
  @endif
</div>

<!-- Main content -->
<main id="main-content">
  @yield('content')
</main>

<!-- WhatsApp floating button -->
<a href="https://wa.me/21628878286" target="_blank" rel="noopener" class="btn-whatsapp-float" title="Contacter sur WhatsApp"
   style="position:fixed;bottom:30px;left:20px;z-index:999;background:#25d366;color:white;border-radius:50%;width:54px;height:54px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.2);text-decoration:none;font-size:24px;transition:transform 0.2s">
  <i class="fab fa-whatsapp"></i>
</a>

<!-- Scroll to top -->
<button id="scroll-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Retour en haut">
  <i class="fas fa-chevron-up"></i>
</button>

<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-3 mt-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-3">
        <div class="logo-text mb-3">
          <span class="text-danger fw-bold fs-4">Auto</span><span class="text-white fw-bold fs-4">Part</span><span class="text-muted small">.tn</span>
        </div>
        <p class="text-muted small">Votre spécialiste en pièces automobiles en ligne en Tunisie. Qualité garantie, livraison rapide.</p>
        <div class="d-flex gap-2 mt-3">
          <a href="https://www.facebook.com/autoparttn/" target="_blank" class="btn btn-outline-light btn-sm" rel="noopener"><i class="fab fa-facebook-f"></i></a>
          <a href="https://wa.me/21628878286" target="_blank" class="btn btn-outline-light btn-sm" rel="noopener"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      <div class="col-md-3">
        <h6 class="fw-bold mb-3 text-white">Liens rapides</h6>
        <ul class="list-unstyled small ">
          <li class="mb-2"><a href="{{ route('home') }}" class="text-muted text-decoration-none hover-link">Accueil</a></li>
          <li class="mb-2"><a href="{{ route('search') }}" class="text-muted text-decoration-none hover-link">Rechercher une pièce</a></li>
          <li class="mb-2"><a href="{{ route('cart.index') }}" class="text-muted text-decoration-none hover-link">Mon panier</a></li>
          @auth
          <li class="mb-2"><a href="{{ route('account.orders') }}" class="text-muted text-decoration-none hover-link">Mes commandes</a></li>
          @else
          <li class="mb-2"><a href="{{ route('login') }}" class="text-muted text-decoration-none hover-link">Mon compte</a></li>
          @endauth
          <li class="mb-2"><a href="{{ route('support') }}" class="text-muted text-decoration-none hover-link">Support</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h6 class="fw-bold mb-3 text-white">Informations</h6>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="{{ route('cgv') }}" class="text-muted text-decoration-none hover-link">Conditions de vente</a></li>
          <li class="mb-2"><a href="{{ route('privacy') }}" class="text-muted text-decoration-none hover-link">Politique de confidentialité</a></li>
          <li class="mb-2"><a href="{{ route('contact') }}" class="text-muted text-decoration-none hover-link">Contactez-nous</a></li>
        </ul>
        <div class="mt-3">
          <div class="small text-muted mb-1"><i class="fas fa-truck me-2 text-success"></i>Livraison gratuite dès 200 TND</div>
          <div class="small text-muted mb-1"><i class="fas fa-shield-alt me-2 text-primary"></i>Pièces qualité garantie</div>
          <div class="small text-muted"><i class="fas fa-undo me-2 text-warning"></i>Retours sous 30 jours</div>
        </div>
      </div>
      <div class="col-md-3">
        <h6 class="fw-bold mb-3 text-white">Contact</h6>
        <ul class="list-unstyled small">
          <li class="mb-2 text-muted"><i class="fas fa-map-marker-alt me-2 text-danger"></i>Bengardene, Mednine</li>
          <li class="mb-2"><a href="tel:+21623136136" class="text-muted text-decoration-none"><i class="fas fa-phone me-2 text-success"></i>+216 28 878 286</a></li>
          <li class="mb-2"><a href="mailto:autopart.tunisia@gmail.com" class="text-muted text-decoration-none"><i class="fas fa-envelope me-2 text-warning"></i>autopart.tunisia@gmail.com</a></li>
          <li class="mb-2 text-muted"><i class="fas fa-clock me-2"></i>Lun-Ven: 8h30-17h00 | Sam: 8h-12h</li>
        </ul>
      </div>
    </div>
    <hr class="border-secondary mt-4">
    <div class="row align-items-center">
      <div class="col-md-6 text-muted small">© {{ date('Y') }} AutoPart Online. Tous droits réservés.</div>
      <div class="col-md-6 text-end text-muted small">Conçu avec <i class="fas fa-heart text-danger"></i> pour l'automobile tunisienne</div>
    </div>
  </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
// Scroll to top button
window.addEventListener('scroll', function() {
    var btn = document.getElementById('scroll-top');
    if (btn) btn.classList.toggle('visible', window.scrollY > 300);
});
</script>
@stack('scripts')
</body>
</html>
