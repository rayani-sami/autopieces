<?php $__env->startSection('title','Gestion Agents'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Agents</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Gestion des Agents</h4>
        <p class="text-muted small mb-0"><?php echo e($agents->total()); ?> agent(s)</p>
    </div>
    <a href="<?php echo e(route('admin.agents.create')); ?>" class="btn btn-bh-primary">
        <i class="fa fa-plus me-1"></i>Nouvel agent
    </a>
</div>

<form method="GET" class="card bh-card p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" value="<?php echo e(request('search')); ?>" placeholder="🔍 Nom, prénom, email...">
        </div>
        <div class="col-md-3">
            <select name="statut" class="form-select">
                <option value="">Tous</option>
                <option value="actif" <?php echo e(request('statut')=='actif'?'selected':''); ?>>Actif</option>
                <option value="bloque" <?php echo e(request('statut')=='bloque'?'selected':''); ?>>Bloqué</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-bh-primary"><i class="fa fa-search me-1"></i>Filtrer</button>
            <a href="<?php echo e(route('admin.agents.index')); ?>" class="btn btn-outline-secondary ms-1"><i class="fa fa-times"></i></a>
        </div>
    </div>
</form>

<div class="card bh-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Agent</th><th>CIN</th><th>Téléphone</th><th>Statut</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-muted small"><?php echo e($agent->id); ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bh-avatar-sm" style="background:var(--bh-navy)"><?php echo e(strtoupper(substr($agent->prenom,0,1))); ?></div>
                            <div>
                                <div class="fw-semibold small"><?php echo e($agent->nom_complet); ?></div>
                                <div class="text-muted" style="font-size:11px"><?php echo e($agent->email); ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="small"><?php echo e($agent->cin ?? '—'); ?></td>
                    <td class="small"><?php echo e($agent->telephone ?? '—'); ?></td>
                    <td><span class="badge bg-<?php echo e($agent->statut === 'actif' ? 'success' : 'danger'); ?>"><?php echo e(ucfirst($agent->statut)); ?></span></td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="<?php echo e(route('admin.agents.show', $agent)); ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>
                            <a href="<?php echo e(route('admin.agents.edit', $agent)); ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                            <?php if($agent->statut === 'actif'): ?>
                            <form action="<?php echo e(route('admin.agents.bloquer', $agent)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-outline-warning" data-confirm="Bloquer cet agent ?"><i class="fa fa-ban"></i></button>
                            </form>
                            <?php else: ?>
                            <form action="<?php echo e(route('admin.agents.debloquer', $agent)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-outline-success"><i class="fa fa-unlock"></i></button>
                            </form>
                            <?php endif; ?>
                            <form action="<?php echo e(route('admin.agents.destroy', $agent)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-outline-danger" data-confirm="Supprimer cet agent ?"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center py-5 text-muted"><i class="fa fa-user-tie fa-2x mb-2 d-block"></i>Aucun agent</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($agents->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($agents->appends(request()->query())->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/agents/index.blade.php ENDPATH**/ ?>