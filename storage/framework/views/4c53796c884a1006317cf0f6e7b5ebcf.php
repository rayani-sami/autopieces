<?php $__env->startSection('page-title','Marques automobiles'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <a href="<?php echo e(route('admin.marques.create')); ?>" class="btn btn-danger"><i class="fas fa-plus me-1"></i>Nouvelle marque</a>
  <span class="text-muted small"><?php echo e($makes->count()); ?> marques</span>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="table-light">
        <tr><th>Logo</th><th>Marque</th><th>Modèles</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($make->logo): ?>
              <img src="<?php echo e(Storage::url($make->logo)); ?>" style="height:30px;width:50px;object-fit:contain" alt="<?php echo e($make->name); ?>">
            <?php else: ?>
              <i class="fas fa-car text-muted"></i>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </td>
          <td class="fw-semibold"><?php echo e($make->name); ?></td>
          <td>
            <a href="<?php echo e(route('admin.marques.modeles.index', $make)); ?>" class="badge bg-info text-decoration-none">
              <?php echo e($make->models_count); ?> modèles
            </a>
          </td>
          <td class="text-muted small"><?php echo e($make->sort_order); ?></td>
          <td><span class="badge bg-<?php echo e($make->is_active ? 'success' : 'secondary'); ?>"><?php echo e($make->is_active ? 'Actif' : 'Inactif'); ?></span></td>
          <td>
            <a href="<?php echo e(route('admin.marques.modeles.index', $make)); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-list me-1"></i>Modèles</a>
            <a href="<?php echo e(route('admin.marques.edit', $make)); ?>" class="btn btn-outline-secondary btn-sm ms-1"><i class="fas fa-edit"></i></a>
            <form action="<?php echo e(route('admin.marques.destroy', $make)); ?>" method="POST" class="d-inline">
              <?php echo csrf_field(); ?>
              <?php echo method_field('DELETE'); ?>
              <button type="submit" class="btn btn-outline-danger btn-sm ms-1" onclick="return confirm('Supprimer ?')">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">Aucune marque. <a href="<?php echo e(route('admin.marques.create')); ?>">Ajouter</a></td></tr>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/vehicles/makes.blade.php ENDPATH**/ ?>