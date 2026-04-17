<?php $__env->startSection('title','Mes Offres'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Offres & Catalogues</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Offres & Catalogues</h4>
    <a href="<?php echo e(route('agent.offres.create')); ?>" class="btn btn-bh-primary"><i class="fa fa-plus me-1"></i>Nouvelle offre</a>
</div>
<form method="GET" class="card bh-card p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-4">
            <select name="categorie_id" class="form-select form-select-sm">
                <option value="">Toutes catégories</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>" <?php echo e(request('categorie_id')==$cat->id?'selected':''); ?>><?php echo e($cat->nom); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="statut" class="form-select form-select-sm">
                <option value="">Tous</option>
                <option value="active" <?php echo e(request('statut')=='active'?'selected':''); ?>>Active</option>
                <option value="inactive" <?php echo e(request('statut')=='inactive'?'selected':''); ?>>Inactive</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-bh-primary btn-sm"><i class="fa fa-filter me-1"></i>Filtrer</button>
            <a href="<?php echo e(route('agent.offres.index')); ?>" class="btn btn-outline-secondary btn-sm ms-1"><i class="fa fa-times"></i></a>
        </div>
    </div>
</form>
<div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $offres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-md-6 col-lg-4">
        <div class="card bh-card h-100">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background:var(--bh-navy);color:white">
                <div>
                    <div class="fw-bold small"><?php echo e(Str::limit($offre->titre,35)); ?></div>
                    <div style="font-size:11px;opacity:.7"><?php echo e($offre->categorie?->nom ?? 'Non catégorisée'); ?></div>
                </div>
                <span class="badge bg-<?php echo e($offre->est_active ? 'success' : 'secondary'); ?>"><?php echo e($offre->est_active ? 'Active' : 'Off'); ?></span>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-2"><?php echo e(Str::limit($offre->description, 90)); ?></p>
                <div class="d-flex flex-wrap gap-1">
                    <?php if($offre->taux_interet): ?><span class="badge bg-success-subtle text-success small"><?php echo e($offre->taux_interet); ?>%</span><?php endif; ?>
                    <?php if($offre->duree_mois): ?><span class="badge bg-info-subtle text-info small"><?php echo e($offre->duree_mois); ?> mois</span><?php endif; ?>
                    <?php if($offre->avis_count ?? $offre->avis->count()): ?><span class="bh-stars small"><i class="fa fa-star"></i> <?php echo e($offre->avis->count()); ?> avis</span><?php endif; ?>
                </div>
            </div>
            <div class="card-footer bg-transparent d-flex gap-2">
                <a href="<?php echo e(route('agent.offres.edit', $offre)); ?>" class="btn btn-sm btn-outline-primary flex-grow-1"><i class="fa fa-edit me-1"></i>Modifier</a>
                <form action="<?php echo e(route('agent.offres.destroy', $offre)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-outline-danger" data-confirm="Supprimer cette offre ?"><i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12 text-center py-5 text-muted">
        <i class="fa fa-tags fa-3x mb-3 d-block"></i>
        Aucune offre. <a href="<?php echo e(route('agent.offres.create')); ?>">Créez votre première offre</a>
    </div>
    <?php endif; ?>
</div>
<?php if($offres->hasPages()): ?>
<div class="mt-4"><?php echo e($offres->appends(request()->query())->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/agent/offres/index.blade.php ENDPATH**/ ?>