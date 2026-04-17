<?php $__env->startSection('title','Rendez-vous'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Rendez-vous</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<h4 class="fw-bold mb-4">Gestion des Rendez-vous</h4>
<form method="GET" class="card bh-card p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-3">
            <select name="statut" class="form-select form-select-sm">
                <option value="">Tous statuts</option>
                <option value="en_attente" <?php echo e(request('statut')=='en_attente'?'selected':''); ?>>En attente</option>
                <option value="accepte" <?php echo e(request('statut')=='accepte'?'selected':''); ?>>Accepté</option>
                <option value="refuse" <?php echo e(request('statut')=='refuse'?'selected':''); ?>>Refusé</option>
                <option value="annule" <?php echo e(request('statut')=='annule'?'selected':''); ?>>Annulé</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="date" class="form-control form-control-sm" value="<?php echo e(request('date')); ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-bh-primary btn-sm"><i class="fa fa-filter me-1"></i>Filtrer</button>
            <a href="<?php echo e(route('agent.reservations.index')); ?>" class="btn btn-outline-secondary btn-sm ms-1"><i class="fa fa-times"></i></a>
        </div>
    </div>
</form>
<div class="card bh-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Client</th><th>Agence</th><th>Date & Heure</th><th>Motif</th><th>Statut</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="fw-semibold small"><?php echo e($r->client->nom_complet); ?></div>
                        <div class="text-muted" style="font-size:11px"><?php echo e($r->client->telephone); ?></div>
                    </td>
                    <td class="small"><?php echo e($r->agence->nom); ?></td>
                    <td class="small"><?php echo e($r->date_rdv->format('d/m/Y')); ?><br><span class="text-muted"><?php echo e(substr($r->heure_rdv,0,5)); ?></span></td>
                    <td class="small"><?php echo e(Str::limit($r->motif,35)); ?></td>
                    <td><span class="badge bg-<?php echo e($r->statutClass()); ?>"><?php echo e($r->statutLabel()); ?></span></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('agent.reservations.show', $r)); ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Aucun rendez-vous</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($reservations->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($reservations->appends(request()->query())->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/agent/reservations/index.blade.php ENDPATH**/ ?>