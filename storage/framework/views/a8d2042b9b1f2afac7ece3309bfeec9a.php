<?php $__env->startSection('title', $make->name . ' - Modèles - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Accueil</a></li>
      <li class="breadcrumb-item active"><?php echo e($make->name); ?></li>
    </ol>
  </nav>
  <h1 class="fw-bold mb-4"><i class="fas fa-car text-danger me-2"></i><?php echo e($make->name); ?> - Choisir un modèle</h1>
  <div class="row g-3">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-md-4 col-lg-3">
      <a href="<?php echo e(route('vehicle.engines', [$make->slug, $model->slug])); ?>" class="card text-decoration-none text-dark border-0 shadow-sm h-100 hover-card">
        <div class="card-body text-center p-3">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($model->image): ?><img src="<?php echo e(Storage::url($model->image)); ?>" alt="<?php echo e($model->name); ?>" class="mb-2" style="height:60px;object-fit:contain"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="fw-semibold"><?php echo e($model->name); ?></div>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($model->year_from): ?><div class="text-muted small"><?php echo e($model->year_from); ?><?php echo e($model->year_to ? ' - '.$model->year_to : '+'); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/vehicle/models.blade.php ENDPATH**/ ?>