<?php $__env->startSection('title', $make->name . ' ' . $model->name . ' - Pièces - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Accueil</a></li>
      <li class="breadcrumb-item"><a href="<?php echo e(route('vehicle.models', $make->slug)); ?>"><?php echo e($make->name); ?></a></li>
      <li class="breadcrumb-item"><a href="<?php echo e(route('vehicle.engines', [$make->slug, $model->slug])); ?>"><?php echo e($model->name); ?></a></li>
      <li class="breadcrumb-item active">Pièces</li>
    </ol>
  </nav>

  <div class="alert alert-success border-success mb-4">
    <div class="d-flex align-items-center">
      <i class="fas fa-car fa-2x text-success me-3"></i>
      <div>
        <h5 class="mb-0 fw-bold"><?php echo e($make->name); ?> <?php echo e($model->name); ?></h5>
        <div class="text-muted"><?php echo e($engine->full_name); ?>

          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine->year_from): ?> · <?php echo e($engine->year_from); ?><?php echo e($engine->year_to ? '-'.$engine->year_to : '+'); ?><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <h1 class="fw-bold mb-4">Catégories de pièces disponibles</h1>
  <div class="row g-3">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-md-4 col-lg-3">
      <a href="<?php echo e(route('vehicle.category.parts', [$make->slug, $model->slug, $engine->slug, $cat->slug])); ?>" class="card text-decoration-none text-dark border-0 shadow-sm h-100 category-card text-center">
        <div class="card-body p-3">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cat->image): ?><img src="<?php echo e(Storage::url($cat->image)); ?>" alt="<?php echo e($cat->name); ?>" class="mb-2" style="height:50px;object-fit:contain"><?php else: ?><i class="fas fa-cog fa-2x text-danger mb-2"></i><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="fw-semibold small"><?php echo e($cat->name); ?></div>
        </div>
      </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>

  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredProducts->count()): ?>
  <div class="mt-5">
    <h4 class="fw-bold mb-3">Pièces populaires pour ce véhicule</h4>
    <div class="row g-3">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="col-6 col-md-3"><?php echo $__env->make('components.product-card', compact('product'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/vehicle/parts.blade.php ENDPATH**/ ?>