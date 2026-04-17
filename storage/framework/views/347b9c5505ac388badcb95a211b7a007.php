<?php $__env->startSection('title','Mes adresses - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mes adresses</h1>
  <div class="row g-4">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6">
      <div class="card border-0 shadow-sm <?php echo e($addr->is_default?'border-success':''); ?>">
        <div class="card-body">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($addr->is_default): ?><span class="badge bg-success mb-2">Adresse principale</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <h6 class="fw-bold"><?php echo e($addr->label); ?></h6>
          <p class="mb-1"><?php echo e($addr->first_name); ?> <?php echo e($addr->last_name); ?></p>
          <p class="mb-1 text-muted small"><?php echo e($addr->address_line1); ?></p>
          <p class="mb-1 text-muted small"><?php echo e($addr->city); ?><?php echo e($addr->state?', '.$addr->state:''); ?></p>
          <p class="mb-0 text-muted small">Tél: <?php echo e($addr->phone); ?></p>
          <div class="mt-3 d-flex gap-2">
            <form action="<?php echo e(route('account.addresses.delete',$addr)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button></form>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="col-md-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Ajouter une adresse</h5>
          <form action="<?php echo e(route('account.addresses.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row g-2">
              <div class="col-12"><input type="text" name="label" class="form-control form-control-sm" placeholder="Label (Maison, Bureau...)" required></div>
              <div class="col-6"><input type="text" name="first_name" class="form-control form-control-sm" placeholder="Prénom" required></div>
              <div class="col-6"><input type="text" name="last_name" class="form-control form-control-sm" placeholder="Nom" required></div>
              <div class="col-12"><input type="text" name="phone" class="form-control form-control-sm" placeholder="Téléphone" required></div>
              <div class="col-12"><input type="text" name="address_line1" class="form-control form-control-sm" placeholder="Adresse" required></div>
              <div class="col-6"><input type="text" name="city" class="form-control form-control-sm" placeholder="Ville" required></div>
              <div class="col-6"><input type="text" name="state" class="form-control form-control-sm" placeholder="Gouvernorat"></div>
              <div class="col-12"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_default" value="1"><label class="form-check-label small">Adresse principale</label></div></div>
              <div class="col-12"><button type="submit" class="btn btn-danger btn-sm w-100">Ajouter</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/account/addresses.blade.php ENDPATH**/ ?>