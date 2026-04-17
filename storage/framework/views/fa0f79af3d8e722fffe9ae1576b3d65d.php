<?php $__env->startSection('title','Mes Réservations'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Mes réservations</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Mes Réservations</h4>
    <a href="<?php echo e(route('client.reservations.create')); ?>" class="btn btn-bh-primary">
        <i class="fa fa-plus me-1"></i>Nouveau RDV
    </a>
</div>
<div class="card bh-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Date</th><th>Heure</th><th>Agence</th><th>Motif</th><th>Statut</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="fw-semibold small"><?php echo e($r->date_rdv->format('d/m/Y')); ?></td>
                    <td class="small"><?php echo e(substr($r->heure_rdv,0,5)); ?></td>
                    <td class="small"><?php echo e($r->agence->nom); ?></td>
                    <td class="small"><?php echo e(Str::limit($r->motif, 40)); ?></td>
                    <td><span class="badge bg-<?php echo e($r->statutClass()); ?>"><?php echo e($r->statutLabel()); ?></span></td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="<?php echo e(route('client.reservations.show', $r)); ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>
                            <?php if($r->statut === 'en_attente'): ?>
                            <a href="<?php echo e(route('client.reservations.edit', $r)); ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                            <form action="<?php echo e(route('client.reservations.annuler', $r)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-outline-danger" data-confirm="Annuler ce rendez-vous ?"><i class="fa fa-times"></i></button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fa fa-calendar-times fa-3x mb-3 d-block"></i>
                        Aucune réservation pour l'instant.
                        <a href="<?php echo e(route('client.reservations.create')); ?>" class="d-block mt-2">Prendre mon premier rendez-vous</a>
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

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/client/reservations/index.blade.php ENDPATH**/ ?>