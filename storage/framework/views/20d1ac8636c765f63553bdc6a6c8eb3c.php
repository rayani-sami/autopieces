<?php $__env->startSection('title','Dashboard Agent'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Tableau de bord</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h4 class="fw-bold mb-0">Bonjour, <?php echo e(auth()->user()->prenom); ?> 👋</h4>
    <p class="text-muted small">Gérez vos rendez-vous et offres bancaires</p>
</div>
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#fef9c3"><i class="fa fa-clock text-warning"></i></div>
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
                <div class="bh-stat-icon" style="background:#e0e7ff"><i class="fa fa-calendar text-indigo" style="color:#4f46e5"></i></div>
                <div><div class="fw-bold fs-4"><?php echo e($stats['total_rdv']); ?></div><div class="text-muted small">Total RDV</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#ede9fe"><i class="fa fa-tags" style="color:#7c3aed"></i></div>
                <div><div class="fw-bold fs-4"><?php echo e($stats['mes_offres']); ?></div><div class="text-muted small">Mes offres</div></div>
            </div>
        </div>
    </div>
</div>

<?php if($stats['non_assignees'] > 0): ?>
<div class="alert alert-warning d-flex align-items-center gap-2 mb-4">
    <i class="fa fa-exclamation-triangle fa-lg"></i>
    <div>
        <strong><?php echo e($stats['non_assignees']); ?> demande(s) de RDV</strong> en attente d'un agent.
        <a href="<?php echo e(route('agent.reservations.index')); ?>" class="alert-link ms-1">Traiter maintenant →</a>
    </div>
</div>
<?php endif; ?>

<div class="card bh-card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold"><i class="fa fa-calendar-alt me-2 text-primary"></i>Demandes de rendez-vous</h6>
        <a href="<?php echo e(route('agent.reservations.index')); ?>" class="btn btn-sm btn-outline-primary">Voir tout</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Client</th><th>Agence</th><th>Date</th><th>Motif</th><th>Statut</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="small fw-semibold"><?php echo e($r->client->nom_complet); ?></td>
                    <td class="small"><?php echo e($r->agence->ville); ?></td>
                    <td class="small"><?php echo e($r->date_rdv->format('d/m/Y')); ?> à <?php echo e(substr($r->heure_rdv,0,5)); ?></td>
                    <td class="small"><?php echo e(Str::limit($r->motif,30)); ?></td>
                    <td><span class="badge bg-<?php echo e($r->statutClass()); ?>"><?php echo e($r->statutLabel()); ?></span></td>
                    <td>
                        <a href="<?php echo e(route('agent.reservations.show', $r)); ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center text-muted py-3">Aucune demande</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/agent/dashboard/index.blade.php ENDPATH**/ ?>