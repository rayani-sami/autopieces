<?php $__env->startSection('title','Mes commandes - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mes commandes</h1>
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h6 class="fw-bold mb-1"><a href="<?php echo e(route('account.order.detail',$order)); ?>" class="text-decoration-none text-dark"><?php echo e($order->order_number); ?></a></h6>
          <div class="text-muted small"><?php echo e($order->created_at->format('d/m/Y à H:i')); ?></div>
          <div class="mt-2"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span class="badge bg-light text-dark border me-1 small"><?php echo e(Str::limit($item->product_name,25)); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
        </div>
        <div class="text-end">
          <span class="badge bg-<?php echo e($order->status_color); ?> mb-1"><?php echo e($order->status_label); ?></span>
          <div class="fw-bold text-danger"><?php echo e(number_format($order->total,3)); ?> TND</div>
          <a href="<?php echo e(route('account.order.detail',$order)); ?>" class="btn btn-outline-danger btn-sm mt-2">Détails</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <div class="text-center py-5 text-muted"><i class="fas fa-shopping-bag fa-3x mb-3"></i><h5>Aucune commande</h5><a href="<?php echo e(route('home')); ?>" class="btn btn-danger mt-2">Commencer mes achats</a></div>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  <?php echo e($orders->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/account/orders.blade.php ENDPATH**/ ?>