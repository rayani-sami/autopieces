<?php $__env->startSection('title', 'Tableau de bord Admin'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Tableau de bord</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h4 class="fw-bold mb-0">Tableau de bord</h4>
    <p class="text-muted small">Vue d'ensemble de la plateforme BH Bank</p>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-2">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#e8f0fe">
                    <i class="fa fa-users text-primary"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4"><?php echo e($stats['clients']); ?></div>
                    <div class="text-muted small">Clients</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#fef3c7">
                    <i class="fa fa-user-tie text-warning"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4"><?php echo e($stats['agents']); ?></div>
                    <div class="text-muted small">Agents</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#d1fae5">
                    <i class="fa fa-calendar-check text-success"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4"><?php echo e($stats['reservations']); ?></div>
                    <div class="text-muted small">RDV</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#ede9fe">
                    <i class="fa fa-tags text-purple" style="color:#7c3aed"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4"><?php echo e($stats['offres']); ?></div>
                    <div class="text-muted small">Offres</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#f0f9ff">
                    <i class="fa fa-building text-info"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4"><?php echo e($stats['agences']); ?></div>
                    <div class="text-muted small">Agences</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="card bh-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bh-stat-icon" style="background:#fff1f2">
                    <i class="fa fa-ban text-danger"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4"><?php echo e($stats['bloques']); ?></div>
                    <div class="text-muted small">Bloqués</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Réservations récentes -->
    <div class="col-lg-7">
        <div class="card bh-card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="fa fa-calendar-alt me-2 text-primary"></i>Réservations récentes</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small">Client</th>
                                <th class="small">Agence</th>
                                <th class="small">Date</th>
                                <th class="small">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $reservations_recentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="small"><?php echo e($r->client->nom_complet); ?></td>
                                <td class="small"><?php echo e($r->agence->ville); ?></td>
                                <td class="small"><?php echo e($r->date_rdv->format('d/m/Y')); ?></td>
                                <td><span class="badge bg-<?php echo e($r->statutClass()); ?>"><?php echo e($r->statutLabel()); ?></span></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Clients récents -->
    <div class="col-lg-5">
        <div class="card bh-card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="fa fa-user-plus me-2 text-success"></i>Nouveaux clients</h6>
                <a href="<?php echo e(route('admin.clients.index')); ?>" class="btn btn-sm btn-outline-primary">Voir tout</a>
            </div>
            <div class="list-group list-group-flush">
                <?php $__currentLoopData = $clients_recents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="list-group-item d-flex align-items-center gap-3 py-3">
                    <div class="bh-avatar-sm"><?php echo e(strtoupper(substr($c->prenom,0,1))); ?></div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold small"><?php echo e($c->nom_complet); ?></div>
                        <div class="text-muted" style="font-size:11px"><?php echo e($c->email); ?></div>
                    </div>
                    <span class="badge bg-<?php echo e($c->statut === 'actif' ? 'success' : 'danger'); ?>"><?php echo e($c->statut); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>