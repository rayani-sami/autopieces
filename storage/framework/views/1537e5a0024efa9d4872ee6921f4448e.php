<?php $__env->startSection('page-title','Nouvelle catégorie'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-md-6">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="mb-3"><label class="fw-semibold small">Nom *</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label class="fw-semibold small">Catégorie parente</label><select name="parent_id" class="form-select"><option value="">— Racine —</option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></select></div>
        <div class="mb-3"><label class="fw-semibold small">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
        <div class="mb-3"><label class="fw-semibold small">Image</label><input type="file" name="image" class="form-control" accept="image/*"></div>
        <div class="mb-3"><label class="fw-semibold small">Ordre</label><input type="number" name="sort_order" class="form-control" value="0"></div>
        <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Actif</label></div>
        <button type="submit" class="btn btn-danger w-100">Créer</button>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>