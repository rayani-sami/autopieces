<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — BH Bank</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/bh.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bh-dash-body">

<div class="d-flex" style="min-height:100vh">

    <!-- ══ SIDEBAR ══════════════════════════════════════════════ -->
    <div class="bh-sidebar d-flex flex-column" id="sidebar">
        <div class="bh-sidebar-brand py-4 px-3">
            <a href="<?php echo e(route('home')); ?>" class="d-flex align-items-center gap-2 text-decoration-none">
                <div class="bh-logo-circle"><span>BH</span></div>
                <span class="fw-bold text-white fs-5 sidebar-label">BH Bank</span>
            </a>
        </div>

        <!-- Role Badge -->
        <div class="px-3 mb-3">
            <div class="bh-role-badge sidebar-label">
                <?php if(auth()->user()->isAdmin()): ?>
                    <i class="fa fa-shield-alt me-1"></i> Administrateur
                <?php elseif(auth()->user()->isAgent()): ?>
                    <i class="fa fa-user-tie me-1"></i> Agent de Bank
                <?php else: ?>
                    <i class="fa fa-user me-1"></i> Client
                <?php endif; ?>
            </div>
        </div>

        <nav class="flex-grow-1 px-2">
            <ul class="nav flex-column gap-1">

            <?php if(auth()->user()->isAdmin()): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <i class="fa fa-tachometer-alt"></i>
                        <span class="sidebar-label ms-2">Tableau de bord</span>
                    </a>
                </li>
                <li class="bh-sidebar-divider sidebar-label">Gestion</li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.clients.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('admin.clients*') ? 'active' : ''); ?>">
                        <i class="fa fa-users"></i>
                        <span class="sidebar-label ms-2">Clients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.agents.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('admin.agents*') ? 'active' : ''); ?>">
                        <i class="fa fa-user-tie"></i>
                        <span class="sidebar-label ms-2">Agents</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.agences.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('admin.agences*') ? 'active' : ''); ?>">
                        <i class="fa fa-building"></i>
                        <span class="sidebar-label ms-2">Agences</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.reservations.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('admin.reservations*') ? 'active' : ''); ?>">
                        <i class="fa fa-calendar-alt"></i>
                        <span class="sidebar-label ms-2">Réservations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.avis.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('admin.avis*') ? 'active' : ''); ?>">
                        <i class="fa fa-star"></i>
                        <span class="sidebar-label ms-2">Avis clients</span>
                    </a>
                </li>

            <?php elseif(auth()->user()->isAgent()): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('agent.dashboard')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('agent.dashboard') ? 'active' : ''); ?>">
                        <i class="fa fa-tachometer-alt"></i>
                        <span class="sidebar-label ms-2">Tableau de bord</span>
                    </a>
                </li>
                <li class="bh-sidebar-divider sidebar-label">Gestion</li>
                <li class="nav-item">
                    <a href="<?php echo e(route('agent.reservations.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('agent.reservations*') ? 'active' : ''); ?>">
                        <i class="fa fa-calendar-check"></i>
                        <span class="sidebar-label ms-2">Rendez-vous</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('agent.offres.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('agent.offres*') ? 'active' : ''); ?>">
                        <i class="fa fa-tags"></i>
                        <span class="sidebar-label ms-2">Offres & Catalogues</span>
                    </a>
                </li>
                <li class="bh-sidebar-divider sidebar-label">Compte</li>
                <li class="nav-item">
                    <a href="<?php echo e(route('agent.profil.edit')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('agent.profil*') ? 'active' : ''); ?>">
                        <i class="fa fa-user-edit"></i>
                        <span class="sidebar-label ms-2">Mon profil</span>
                    </a>
                </li>

            <?php else: ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('client.dashboard')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('client.dashboard') ? 'active' : ''); ?>">
                        <i class="fa fa-tachometer-alt"></i>
                        <span class="sidebar-label ms-2">Tableau de bord</span>
                    </a>
                </li>
                <li class="bh-sidebar-divider sidebar-label">Mon espace</li>
                <li class="nav-item">
                    <a href="<?php echo e(route('client.reservations.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('client.reservations*') ? 'active' : ''); ?>">
                        <i class="fa fa-calendar-alt"></i>
                        <span class="sidebar-label ms-2">Mes réservations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('client.avis.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('client.avis*') ? 'active' : ''); ?>">
                        <i class="fa fa-star"></i>
                        <span class="sidebar-label ms-2">Mes avis</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('client.historique.index')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('client.historique*') ? 'active' : ''); ?>">
                        <i class="fa fa-history"></i>
                        <span class="sidebar-label ms-2">Mon historique</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('client.profil.edit')); ?>" class="nav-link bh-nav-link <?php echo e(request()->routeIs('client.profil*') ? 'active' : ''); ?>">
                        <i class="fa fa-user-edit"></i>
                        <span class="sidebar-label ms-2">Mon profil</span>
                    </a>
                </li>
                <li class="bh-sidebar-divider sidebar-label">Banque</li>
                <li class="nav-item">
                    <a href="<?php echo e(route('visitor.offres')); ?>" class="nav-link bh-nav-link">
                        <i class="fa fa-tags"></i>
                        <span class="sidebar-label ms-2">Offres & Catalogues</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('visitor.agences')); ?>" class="nav-link bh-nav-link">
                        <i class="fa fa-map-marker-alt"></i>
                        <span class="sidebar-label ms-2">Nos agences</span>
                    </a>
                </li>
            <?php endif; ?>

            </ul>
        </nav>

        <!-- User Bottom -->
        <div class="p-3 border-top border-secondary">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="bh-avatar-sm"><?php echo e(strtoupper(substr(auth()->user()->prenom,0,1))); ?></div>
                <div class="sidebar-label">
                    <div class="text-white fw-semibold small"><?php echo e(auth()->user()->nom_complet); ?></div>
                    <div class="text-white-50" style="font-size:11px"><?php echo e(auth()->user()->email); ?></div>
                </div>
            </div>
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-sm btn-outline-danger w-100">
                    <i class="fa fa-sign-out-alt"></i>
                    <span class="sidebar-label ms-1">Déconnexion</span>
                </button>
            </form>
        </div>
    </div>

    <!-- ══ MAIN CONTENT ══════════════════════════════════════════ -->
    <div class="flex-grow-1 d-flex flex-column" style="overflow-x:hidden">

        <!-- Top Bar -->
        <div class="bh-topbar d-flex align-items-center px-4">
            <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                <i class="fa fa-bars"></i>
            </button>
            <nav aria-label="breadcrumb" class="flex-grow-1">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="text-decoration-none">BH Bank</a></li>
                    <?php echo $__env->yieldContent('breadcrumb'); ?>
                </ol>
            </nav>
            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo e(route('visitor.chatbot')); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="fa fa-robot me-1"></i><span class="d-none d-md-inline">Chatbot</span>
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <div class="px-4 pt-3">
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
            <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fa fa-exclamation-triangle me-2"></i>
                <strong>Erreurs de validation :</strong>
                <ul class="mb-0 mt-1"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>
        </div>

        <!-- Page Content -->
        <div class="flex-grow-1 p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <footer class="text-center text-muted small py-3 border-top">
            © <?php echo e(date('Y')); ?> BH Bank Tunisie — Application de Gestion
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="<?php echo e(asset('js/bh.js')); ?>"></script>
<script>
document.getElementById('sidebarToggle')?.addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('collapsed');
});
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>