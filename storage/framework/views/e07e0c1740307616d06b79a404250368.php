<?php $__env->startSection('title', $make->name . ' ' . $model->name . ' - Motorisations - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Accueil</a></li>
      <li class="breadcrumb-item"><a href="<?php echo e(route('vehicle.models', $make->slug)); ?>"><?php echo e($make->name); ?></a></li>
      <li class="breadcrumb-item active"><?php echo e($model->name); ?></li>
    </ol>
  </nav>
  <h1 class="fw-bold mb-4"><?php echo e($make->name); ?> <?php echo e($model->name); ?> - Choisir la motorisation</h1>
  <div class="row g-3">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $engines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $engine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-lg-4">
      <a href="<?php echo e(route('vehicle.parts', [$make->slug, $model->slug, $engine->slug])); ?>" class="card text-decoration-none text-dark border-0 shadow-sm hover-card">
        <div class="card-body p-3">
          <div class="fw-semibold"><?php echo e($engine->name); ?></div>
          <div class="text-muted small">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine->fuel_type): ?><span class="badge bg-<?php echo e($engine->fuel_type==='diesel'?'dark':'primary'); ?> me-1"><?php echo e(ucfirst($engine->fuel_type)); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine->power_hp): ?><span><?php echo e($engine->power_hp); ?> ch</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine->engine_code): ?><span class="ms-1 text-muted"><?php echo e($engine->engine_code); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine->year_from): ?><div class="text-muted small mt-1"><?php echo e($engine->year_from); ?><?php echo e($engine->year_to ? ' → '.$engine->year_to : '+'); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/vehicle/engines.blade.php ENDPATH**/ ?>