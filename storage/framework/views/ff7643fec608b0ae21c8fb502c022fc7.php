<?php $__env->startSection('title','Gestion des Avis'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Avis clients</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Avis Clients</h4>
        <p class="text-muted small mb-0"><?php echo e($avis->total()); ?> avis au total</p>
    </div>
</div>

<div class="card bh-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Client</th>
                    <th>Offre</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Date</th>
                    <th>Visibilité</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $avis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $av): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bh-avatar-sm"><?php echo e(strtoupper(substr($av->client->prenom,0,1))); ?></div>
                            <div class="small fw-semibold"><?php echo e($av->client->nom_complet); ?></div>
                        </div>
                    </td>
                    <td class="small"><?php echo e($av->offre ? Str::limit($av->offre->titre,30) : '<span class="text-muted">Général</span>'); ?></td>
                    <td>
                        <span class="bh-stars small">
                            <?php for($i=1;$i<=5;$i++): ?>
                                <i class="fa fa-star<?php echo e($i<=$av->note?'':'-o'); ?>"></i>
                            <?php endfor; ?>
                        </span>
                    </td>
                    <td class="small"><?php echo e(Str::limit($av->commentaire, 50)); ?></td>
                    <td class="small text-muted"><?php echo e($av->created_at->format('d/m/Y')); ?></td>
                    <td>
                        <span class="badge bg-<?php echo e($av->est_visible ? 'success' : 'secondary'); ?>">
                            <?php echo e($av->est_visible ? 'Visible' : 'Masqué'); ?>

                        </span>
                    </td>
                    <td class="text-end">
                        <form action="<?php echo e(route('admin.avis.toggle', $av)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-sm btn-outline-<?php echo e($av->est_visible ? 'warning' : 'success'); ?>" title="<?php echo e($av->est_visible ? 'Masquer' : 'Afficher'); ?>">
                                <i class="fa fa-<?php echo e($av->est_visible ? 'eye-slash' : 'eye'); ?>"></i>
                            </button>
                        </form>
                        <form action="<?php echo e(route('admin.avis.destroy', $av)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-outline-danger" data-confirm="Supprimer cet avis ?">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="fa fa-star fa-2x mb-2 d-block" style="color:#ddd"></i>
                        Aucun avis
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($avis->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($avis->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/avis/index.blade.php ENDPATH**/ ?>