<?php $__env->startSection('page-title','Motorisations - '.$model->make->name.' '.$model->name); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center gap-3 mb-4">
  <a href="<?php echo e(route('admin.marques.modeles.index', $model->make)); ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i></a>
  <h5 class="mb-0 fw-bold">Motorisations: <?php echo e($model->make->name); ?> <?php echo e($model->name); ?></h5>
</div>
<div class="row g-4">
  <div class="col-md-8">
    <div class="card border-0 shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
          <thead class="table-light"><tr><th>Motorisation</th><th>Carburant</th><th>Puissance</th><th>Code</th><th>Années</th><th>Actions</th></tr></thead>
          <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $engines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $engine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td class="fw-semibold"><?php echo e($engine->name); ?></td>
              <td><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine->fuel_type): ?><span class="badge bg-<?php echo e($engine->fuel_type === 'diesel' ? 'dark' : ($engine->fuel_type === 'essence' ? 'primary' : 'success')); ?>"><?php echo e(ucfirst($engine->fuel_type)); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
              <td class="small"><?php echo e($engine->power_hp ? $engine->power_hp.' ch' : '-'); ?></td>
              <td class="small text-muted"><?php echo e($engine->engine_code ?: '-'); ?></td>
              <td class="small text-muted"><?php echo e($engine->year_from); ?><?php echo e($engine->year_to ? '-'.$engine->year_to : '+'); ?></td>
              <td>
                <form action="<?php echo e(route('admin.motorisations.destroy', $engine)); ?>" method="POST" class="d-inline">
                  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer ?')"><i class="fas fa-trash"></i></button>
                </form>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" class="text-center text-muted py-3">Aucune motorisation.</td></tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="fw-bold mb-3">Ajouter une motorisation</h6>
        <form action="<?php echo e(route('admin.modeles.motorisations.store', $model)); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="mb-2"><input type="text" name="name" class="form-control form-control-sm" placeholder="Ex: 1.5 dCi 85ch *" required></div>
          <div class="mb-2">
            <select name="fuel_type" class="form-select form-select-sm">
              <option value="">Carburant</option>
              <option value="essence">Essence</option>
              <option value="diesel">Diesel</option>
              <option value="hybride">Hybride</option>
              <option value="electrique">Électrique</option>
              <option value="gpl">GPL</option>
            </select>
          </div>
          <div class="row g-1 mb-2">
            <div class="col"><input type="text" name="displacement" class="form-control form-control-sm" placeholder="Cylindrée (1.5)"></div>
            <div class="col"><input type="text" name="power_hp" class="form-control form-control-sm" placeholder="Puissance (85)"></div>
          </div>
          <div class="mb-2"><input type="text" name="engine_code" class="form-control form-control-sm" placeholder="Code moteur (K9K)"></div>
          <div class="row g-1 mb-2">
            <div class="col"><input type="number" name="year_from" class="form-control form-control-sm" placeholder="De" min="1980" max="2030"></div>
            <div class="col"><input type="number" name="year_to" class="form-control form-control-sm" placeholder="À" min="1980" max="2030"></div>
          </div>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label small">Actif</label></div>
          <button type="submit" class="btn btn-danger btn-sm w-100">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/vehicles/engines.blade.php ENDPATH**/ ?>