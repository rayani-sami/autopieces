<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'BH Bank'); ?> — BH Bank Tunisie</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <!-- Custom BH Bank CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bh.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<!-- ══ NAVBAR ══════════════════════════════════════════════════ -->
<nav class="navbar navbar-expand-lg navbar-dark bh-navbar shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo e(route('home')); ?>">
            <div class="bh-logo-circle"><span>BH</span></div>
            <span class="fw-bold fs-5">BH Bank</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                        <i class="fa fa-home me-1"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('visitor.offres') ? 'active' : ''); ?>" href="<?php echo e(route('visitor.offres')); ?>">
                        <i class="fa fa-tags me-1"></i> Offres
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('visitor.agences') ? 'active' : ''); ?>" href="<?php echo e(route('visitor.agences')); ?>">
                        <i class="fa fa-map-marker-alt me-1"></i> Agences
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('visitor.chatbot') ? 'active' : ''); ?>" href="<?php echo e(route('visitor.chatbot')); ?>">
                        <i class="fa fa-robot me-1"></i> Chatbot
                    </a>
                </li>
                <?php if(auth()->guard()->check()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                        <i class="fa fa-tachometer-alt me-1"></i> Mon espace
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <?php if(auth()->guard()->guest()): ?>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm px-3" href="<?php echo e(route('login')); ?>">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-bh-gold btn-sm px-3" href="<?php echo e(route('register')); ?>">Inscription</a>
                </li>
                <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                        <div class="bh-avatar-sm"><?php echo e(strtoupper(substr(auth()->user()->prenom,0,1))); ?></div>
                        <span><?php echo e(auth()->user()->prenom); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><h6 class="dropdown-header"><?php echo e(auth()->user()->nom_complet); ?></h6></li>
                        <li><span class="dropdown-item-text text-muted small">
                            <i class="fa fa-circle text-success me-1" style="font-size:8px"></i>
                            <?php echo e(ucfirst(auth()->user()->role)); ?>

                        </span></li>
                        <li><hr class="dropdown-divider"></li>
                        <?php if(auth()->user()->isClient()): ?>
                        <li><a class="dropdown-item" href="<?php echo e(route('client.profil.edit')); ?>"><i class="fa fa-user-edit me-2"></i>Mon profil</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('client.reservations.index')); ?>"><i class="fa fa-calendar me-2"></i>Mes RDV</a></li>
                        <?php endif; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button class="dropdown-item text-danger"><i class="fa fa-sign-out-alt me-2"></i>Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- ══ FLASH MESSAGES ══════════════════════════════════════════ -->
<?php if(session('success') || session('error')): ?>
<div class="container-fluid px-4 mt-2">
    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle me-2"></i><?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ CONTENT ══════════════════════════════════════════════════ -->
<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- ══ FOOTER ══════════════════════════════════════════════════ -->
<footer class="bh-footer mt-5 py-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bh-logo-circle"><span>BH</span></div>
                    <span class="fw-bold text-white fs-5">BH Bank</span>
                </div>
                <p class="text-white-50 small">BH Bank - Votre partenaire financier de confiance depuis 1974.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-white mb-3">Liens rapides</h6>
                <ul class="list-unstyled">
                    <li><a href="<?php echo e(route('visitor.offres')); ?>" class="text-white-50 text-decoration-none small"><i class="fa fa-chevron-right me-1"></i>Nos offres</a></li>
                    <li><a href="<?php echo e(route('visitor.agences')); ?>" class="text-white-50 text-decoration-none small"><i class="fa fa-chevron-right me-1"></i>Nos agences</a></li>
                    <li><a href="<?php echo e(route('visitor.chatbot')); ?>" class="text-white-50 text-decoration-none small"><i class="fa fa-chevron-right me-1"></i>Assistant virtuel</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white mb-3">Contact</h6>
                <p class="text-white-50 small mb-1"><i class="fa fa-phone me-2"></i>+216 71 126 000</p>
                <p class="text-white-50 small mb-1"><i class="fa fa-envelope me-2"></i>contact@bh.com.tn</p>
                <p class="text-white-50 small"><i class="fa fa-map-marker-alt me-2"></i>18 Avenue Mohamed V, Tunis</p>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <p class="text-center text-white-50 small mb-0">© <?php echo e(date('Y')); ?> BH Bank Tunisie. Tous droits réservés.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="<?php echo e(asset('js/bh.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/layouts/app.blade.php ENDPATH**/ ?>