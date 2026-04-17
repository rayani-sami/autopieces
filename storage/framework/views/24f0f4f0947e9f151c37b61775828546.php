<?php $__env->startSection('title','Commande '.$order->order_number.' - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <div class="d-flex align-items-center gap-2 mb-4">
    <a href="<?php echo e(route('account.orders')); ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i></a>
    <h1 class="fw-bold mb-0">Commande <?php echo e($order->order_number); ?></h1>
    <span class="badge bg-<?php echo e($order->status_color); ?>"><?php echo e($order->status_label); ?></span>
  </div>
  <div class="row g-4">
    <div class="col-md-8">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Articles commandés</h5>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="d-flex justify-content-between py-2 border-bottom">
            <div><div class="fw-semibold"><?php echo e($item->product_name); ?></div><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product_reference): ?><div class="text-muted small">Réf: <?php echo e($item->product_reference); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><div class="text-muted small"><?php echo e(number_format($item->unit_price,3)); ?> TND × <?php echo e($item->quantity); ?></div></div>
            <div class="fw-bold"><?php echo e(number_format($item->total_price,3)); ?> TND</div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="mt-3">
            <div class="d-flex justify-content-between text-muted mb-1"><span>Sous-total</span><span><?php echo e(number_format($order->subtotal,3)); ?> TND</span></div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->discount > 0): ?><div class="d-flex justify-content-between text-success mb-1"><span>Réduction</span><span>-<?php echo e(number_format($order->discount,3)); ?> TND</span></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="d-flex justify-content-between text-muted mb-1"><span>Livraison</span><span><?php echo e($order->shipping_cost > 0 ? number_format($order->shipping_cost,3).' TND' : 'Gratuite'); ?></span></div>
            <div class="d-flex justify-content-between fw-bold fs-5 mt-2 pt-2 border-top"><span>Total</span><span class="text-danger"><?php echo e(number_format($order->total,3)); ?> TND</span></div>
          </div>
        </div>
      </div>
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Historique du statut</h5>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->statusHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="d-flex gap-3 mb-3">
            <div class="text-muted small text-nowrap"><?php echo e($history->created_at->format('d/m/Y H:i')); ?></div>
            <div><span class="badge bg-secondary"><?php echo e(\App\Models\Order::STATUSES[$history->status]['label'] ?? $history->status); ?></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($history->comment): ?><div class="text-muted small mt-1"><?php echo e($history->comment); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Livraison</h5>
          <p class="mb-1 fw-semibold"><?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?></p>
          <p class="mb-1 text-muted small"><?php echo e($order->shipping_address); ?></p>
          <p class="mb-1 text-muted small"><?php echo e($order->shipping_city); ?><?php echo e($order->shipping_state ? ', '.$order->shipping_state : ''); ?></p>
          <p class="mb-0 text-muted small"><?php echo e($order->shipping_phone); ?></p>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->tracking_number): ?><div class="mt-2"><span class="fw-semibold small">Tracking:</span> <span class="badge bg-info"><?php echo e($order->tracking_number); ?></span></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>
      <a href="https://wa.me/21623136136?text=Bonjour, question sur ma commande <?php echo e($order->order_number); ?>" target="_blank" class="btn btn-success w-100"><i class="fab fa-whatsapp me-2"></i>Support WhatsApp</a>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/account/order_detail.blade.php ENDPATH**/ ?>