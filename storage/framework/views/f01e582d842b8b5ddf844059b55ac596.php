<?php $__env->startSection('title','Toutes les Réservations'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Réservations</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Toutes les Réservations</h4>
        <p class="text-muted small mb-0">Suivi global des rendez-vous</p>
    </div>
</div>

<form method="GET" class="card bh-card p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-3">
            <select name="statut" class="form-select form-select-sm">
                <option value="">Tous les statuts</option>
                <option value="en_attente" <?php echo e(request('statut')=='en_attente'?'selected':''); ?>>En attente</option>
                <option value="accepte"    <?php echo e(request('statut')=='accepte'?'selected':''); ?>>Acceptées</option>
                <option value="refuse"     <?php echo e(request('statut')=='refuse'?'selected':''); ?>>Refusées</option>
                <option value="annule"     <?php echo e(request('statut')=='annule'?'selected':''); ?>>Annulées</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="date" class="form-control form-control-sm" value="<?php echo e(request('date')); ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-bh-primary btn-sm"><i class="fa fa-filter me-1"></i>Filtrer</button>
            <a href="<?php echo e(route('admin.reservations.index')); ?>" class="btn btn-outline-secondary btn-sm ms-1"><i class="fa fa-times"></i></a>
        </div>
    </div>
</form>

<div class="card bh-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Agent</th>
                    <th>Agence</th>
                    <th>Date & Heure</th>
                    <th>Motif</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-muted small"><?php echo e($r->id); ?></td>
                    <td>
                        <div class="fw-semibold small"><?php echo e($r->client->nom_complet); ?></div>
                        <div class="text-muted" style="font-size:11px"><?php echo e($r->client->telephone); ?></div>
                    </td>
                    <td class="small"><?php echo e($r->agent ? $r->agent->nom_complet : '<span class="text-muted">Non assigné</span>'); ?></td>
                    <td class="small"><?php echo e($r->agence->nom); ?></td>
                    <td class="small">
                        <?php echo e($r->date_rdv->format('d/m/Y')); ?><br>
                        <span class="text-muted"><?php echo e(substr($r->heure_rdv,0,5)); ?></span>
                    </td>
                    <td class="small"><?php echo e(Str::limit($r->motif,30)); ?></td>
                    <td><span class="badge bg-<?php echo e($r->statutClass()); ?>"><?php echo e($r->statutLabel()); ?></span></td>
                    <td class="text-end">
                        <form action="<?php echo e(route('admin.reservations.destroy', $r)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-outline-danger" data-confirm="Supprimer cette réservation ?">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="fa fa-calendar-times fa-2x mb-2 d-block"></i>
                        Aucune réservation trouvée
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($reservations->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($reservations->appends(request()->query())->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/reservations/index.blade.php ENDPATH**/ ?>