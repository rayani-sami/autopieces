<?php $__env->startSection('title','Mon Espace'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Tableau de bord</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h4 class="fw-bold mb-0">Bonjour, <?php echo e(auth()->user()->prenom); ?> 👋</h4>
    <p class="text-muted small">Gérez vos rendez-vous et suivez vos demandes</p>
</div>
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#e0e7ff"><i class="fa fa-calendar-alt" style="color:#4f46e5"></i></div>
                <div><div class="fw-bold fs-4"><?php echo e($stats['total']); ?></div><div class="text-muted small">Total RDV</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#fef9c3"><i class="fa fa-hourglass-half text-warning"></i></div>
                <div><div class="fw-bold fs-4"><?php echo e($stats['en_attente']); ?></div><div class="text-muted small">En attente</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#d1fae5"><i class="fa fa-check-circle text-success"></i></div>
                <div><div class="fw-bold fs-4"><?php echo e($stats['acceptees']); ?></div><div class="text-muted small">Acceptées</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#fff7ed"><i class="fa fa-star text-warning"></i></div>
                <div><div class="fw-bold fs-4"><?php echo e($stats['avis']); ?></div><div class="text-muted small">Mes avis</div></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card bh-card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="fa fa-calendar-check me-2 text-success"></i>Prochains rendez-vous</h6>
                <a href="<?php echo e(route('client.reservations.create')); ?>" class="btn btn-sm btn-bh-primary">
                    <i class="fa fa-plus me-1"></i>Nouveau RDV
                </a>
            </div>
            <div class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $prochains_rdv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-group-item py-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-semibold"><?php echo e($r->motif); ?></div>
                            <div class="text-muted small mt-1">
                                <i class="fa fa-building me-1"></i><?php echo e($r->agence->nom); ?>

                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-primary small"><?php echo e($r->date_rdv->format('d/m/Y')); ?></div>
                            <div class="text-muted" style="font-size:11px"><?php echo e(substr($r->heure_rdv,0,5)); ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="list-group-item text-center text-muted py-4">
                    <i class="fa fa-calendar-times d-block mb-2 fs-3"></i>
                    Aucun rendez-vous à venir.
                    <a href="<?php echo e(route('client.reservations.create')); ?>" class="d-block mt-1">Prendre un rendez-vous</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bh-card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fa fa-bolt me-2 text-warning"></i>Accès rapides</h6>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?php echo e(route('client.reservations.create')); ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                    <div class="bh-stat-icon" style="background:#e0e7ff;width:36px;height:36px"><i class="fa fa-calendar-plus" style="color:#4f46e5;font-size:14px"></i></div>
                    <span class="small fw-semibold">Prendre un RDV</span>
                </a>
                <a href="<?php echo e(route('visitor.offres')); ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                    <div class="bh-stat-icon" style="background:#d1fae5;width:36px;height:36px"><i class="fa fa-tags text-success" style="font-size:14px"></i></div>
                    <span class="small fw-semibold">Consulter les offres</span>
                </a>
                <a href="<?php echo e(route('visitor.agences')); ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                    <div class="bh-stat-icon" style="background:#fef3c7;width:36px;height:36px"><i class="fa fa-map-marker-alt text-warning" style="font-size:14px"></i></div>
                    <span class="small fw-semibold">Trouver une agence</span>
                </a>
                <a href="<?php echo e(route('visitor.chatbot')); ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                    <div class="bh-stat-icon" style="background:#ede9fe;width:36px;height:36px"><i class="fa fa-robot" style="color:#7c3aed;font-size:14px"></i></div>
                    <span class="small fw-semibold">Contacter chatbot</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/client/dashboard/index.blade.php ENDPATH**/ ?>