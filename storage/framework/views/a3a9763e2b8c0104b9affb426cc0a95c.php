<?php $__env->startSection('page-title','Coupons'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between mb-3">
  <a href="<?php echo e(route('admin.coupons.create')); ?>" class="btn btn-danger"><i class="fas fa-plus me-1"></i>Nouveau coupon</a>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>Code</th><th>Type</th><th>Valeur</th><th>Min. commande</th><th>Utilisations</th><th>Expiration</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td class="fw-bold fw-mono"><?php echo e($c->code); ?></td>
          <td><span class="badge bg-<?php echo e($c->type==='percentage'?'info':'primary'); ?>"><?php echo e($c->type==='percentage'?'Pourcentage':'Montant fixe'); ?></span></td>
          <td><?php echo e($c->type==='percentage'?$c->value.'%':number_format($c->value,3).' TND'); ?></td>
          <td class="small"><?php echo e(number_format($c->min_order,3)); ?> TND</td>
          <td><?php echo e($c->used_count); ?><?php echo e($c->usage_limit?' / '.$c->usage_limit:''); ?></td>
          <td class="small"><?php echo e($c->expires_at?$c->expires_at->format('d/m/Y'):'Sans limite'); ?></td>
          <td><span class="badge bg-<?php echo e($c->isValid()?'success':'secondary'); ?>"><?php echo e($c->isValid()?'Valide':'Invalide'); ?></span></td>
          <td>
            <a href="<?php echo e(route('admin.coupons.edit',$c)); ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i></a>
            <form action="<?php echo e(route('admin.coupons.destroy',$c)); ?>" method="POST" class="d-inline"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-outline-danger btn-sm ms-1" onclick="return confirm('Supprimer ?')"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3"><?php echo e($coupons->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/settings/coupons.blade.php ENDPATH**/ ?>