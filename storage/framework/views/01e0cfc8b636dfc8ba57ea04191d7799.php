<?php $__env->startSection('title','Mes véhicules - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mes véhicules</h1>
  <div class="row g-3">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold"><?php echo e($vehicle->label ?: $vehicle->engine->carModel->make->name.' '.$vehicle->engine->carModel->name); ?></h6>
          <div class="text-muted small"><?php echo e($vehicle->engine->full_name); ?></div>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vehicle->plate): ?><div class="badge bg-light text-dark border mt-1"><?php echo e($vehicle->plate); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="mt-3 d-flex gap-2">
            <a href="<?php echo e(route('vehicle.parts',[$vehicle->engine->carModel->make->slug,$vehicle->engine->carModel->slug,$vehicle->engine->slug])); ?>" class="btn btn-danger btn-sm">Voir les pièces</a>
            <form action="<?php echo e(route('account.vehicles.delete',$vehicle)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button></form>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/account/vehicles.blade.php ENDPATH**/ ?>