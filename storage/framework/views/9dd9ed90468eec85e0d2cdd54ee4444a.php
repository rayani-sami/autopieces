<?php $__env->startSection('title','Détail Agent'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.agents.index')); ?>">Agents</a></li>
    <li class="breadcrumb-item active"><?php echo e($agent->nom_complet); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card bh-card text-center p-4">
            <div class="bh-avatar mx-auto mb-3" style="background:var(--bh-navy)"><?php echo e(strtoupper(substr($agent->prenom,0,1))); ?></div>
            <h5 class="fw-bold"><?php echo e($agent->nom_complet); ?></h5>
            <p class="text-muted small"><?php echo e($agent->email); ?></p>
            <span class="badge bg-<?php echo e($agent->statut === 'actif' ? 'success' : 'danger'); ?> px-3 py-2 mb-3"><?php echo e(ucfirst($agent->statut)); ?></span>
            <hr>
            <div class="text-start small">
                <div class="mb-2"><i class="fa fa-id-card me-2 text-muted"></i><strong>CIN :</strong> <?php echo e($agent->cin ?? '—'); ?></div>
                <div class="mb-2"><i class="fa fa-phone me-2 text-muted"></i><strong>Tél :</strong> <?php echo e($agent->telephone ?? '—'); ?></div>
                <div><i class="fa fa-calendar me-2 text-muted"></i><strong>Créé :</strong> <?php echo e($agent->created_at->format('d/m/Y')); ?></div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <a href="<?php echo e(route('admin.agents.edit', $agent)); ?>" class="btn btn-sm btn-outline-primary flex-grow-1"><i class="fa fa-edit me-1"></i>Modifier</a>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card bh-card mb-3">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fa fa-tags me-2 text-primary"></i>Offres publiées (<?php echo e($agent->offres->count()); ?>)</h6>
            </div>
            <div class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $agent->offres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold small"><?php echo e($offre->titre); ?></div>
                        <div class="text-muted" style="font-size:11px"><?php echo e($offre->created_at->format('d/m/Y')); ?></div>
                    </div>
                    <span class="badge bg-<?php echo e($offre->est_active ? 'success' : 'secondary'); ?>"><?php echo e($offre->est_active ? 'Active' : 'Inactive'); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="list-group-item text-muted small py-3 text-center">Aucune offre</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<a href="<?php echo e(route('admin.agents.index')); ?>" class="btn btn-outline-secondary mt-2">
    <i class="fa fa-arrow-left me-1"></i>Retour
</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/agents/show.blade.php ENDPATH**/ ?>