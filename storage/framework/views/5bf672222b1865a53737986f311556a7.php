<?php $__env->startSection('title','Détail Client'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.clients.index')); ?>">Clients</a></li>
    <li class="breadcrumb-item active"><?php echo e($client->nom_complet); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card bh-card text-center p-4">
            <div class="bh-avatar mx-auto mb-3"><?php echo e(strtoupper(substr($client->prenom,0,1))); ?></div>
            <h5 class="fw-bold mb-0"><?php echo e($client->nom_complet); ?></h5>
            <p class="text-muted small mb-3"><?php echo e($client->email); ?></p>
            <span class="badge bg-<?php echo e($client->statut === 'actif' ? 'success' : 'danger'); ?> px-3 py-2">
                <?php echo e(ucfirst($client->statut)); ?>

            </span>
            <hr>
            <div class="text-start small">
                <div class="mb-2"><i class="fa fa-id-card me-2 text-muted"></i><strong>CIN :</strong> <?php echo e($client->cin ?? '—'); ?></div>
                <div class="mb-2"><i class="fa fa-phone me-2 text-muted"></i><strong>Tél :</strong> <?php echo e($client->telephone ?? '—'); ?></div>
                <div class="mb-2"><i class="fa fa-map-marker-alt me-2 text-muted"></i><strong>Adresse :</strong> <?php echo e($client->adresse ?? '—'); ?></div>
                <div><i class="fa fa-calendar me-2 text-muted"></i><strong>Inscrit :</strong> <?php echo e($client->created_at->format('d/m/Y')); ?></div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <?php if($client->statut === 'actif'): ?>
                <form action="<?php echo e(route('admin.clients.bloquer', $client)); ?>" method="POST" class="flex-grow-1">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-warning w-100 btn-sm" data-confirm="Bloquer ce client ?">
                        <i class="fa fa-ban me-1"></i>Bloquer
                    </button>
                </form>
                <?php else: ?>
                <form action="<?php echo e(route('admin.clients.debloquer', $client)); ?>" method="POST" class="flex-grow-1">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-success w-100 btn-sm">
                        <i class="fa fa-unlock me-1"></i>Débloquer
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card bh-card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fa fa-calendar-alt me-2 text-primary"></i>Historique des réservations</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Date</th><th>Heure</th><th>Agence</th><th>Motif</th><th>Statut</th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $client->reservationsClient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="small"><?php echo e($r->date_rdv->format('d/m/Y')); ?></td>
                            <td class="small"><?php echo e(substr($r->heure_rdv,0,5)); ?></td>
                            <td class="small"><?php echo e($r->agence->nom); ?></td>
                            <td class="small"><?php echo e(Str::limit($r->motif, 30)); ?></td>
                            <td><span class="badge bg-<?php echo e($r->statutClass()); ?>"><?php echo e($r->statutLabel()); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-muted py-3">Aucune réservation</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <a href="<?php echo e(route('admin.clients.index')); ?>" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left me-1"></i>Retour à la liste
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/clients/show.blade.php ENDPATH**/ ?>