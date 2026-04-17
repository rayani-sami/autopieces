<?php $__env->startSection('title','Gestion Agences'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Agences</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Gestion des Agences</h4>
    <a href="<?php echo e(route('admin.agences.create')); ?>" class="btn btn-bh-primary"><i class="fa fa-plus me-1"></i>Nouvelle agence</a>
</div>
<div class="card bh-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Agence</th><th>Ville</th><th>Téléphone</th><th>Horaires</th><th>RDV</th><th>Statut</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $agences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="fw-semibold small"><?php echo e($agence->nom); ?></div>
                        <div class="text-muted" style="font-size:11px"><?php echo e($agence->adresse); ?></div>
                    </td>
                    <td class="small"><?php echo e($agence->ville); ?></td>
                    <td class="small"><?php echo e($agence->telephone ?? '—'); ?></td>
                    <td class="small"><?php echo e(substr($agence->heure_ouverture,0,5)); ?> – <?php echo e(substr($agence->heure_fermeture,0,5)); ?></td>
                    <td><span class="badge bg-info-subtle text-info"><?php echo e($agence->reservations_count); ?></span></td>
                    <td><span class="badge bg-<?php echo e($agence->est_active ? 'success' : 'secondary'); ?>"><?php echo e($agence->est_active ? 'Active' : 'Inactive'); ?></span></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('admin.agences.edit', $agence)); ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                        <form action="<?php echo e(route('admin.agences.destroy', $agence)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-outline-danger" data-confirm="Supprimer cette agence ?"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center py-4 text-muted">Aucune agence</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/agences/index.blade.php ENDPATH**/ ?>