<?php $__env->startSection('title','Commande confirmée - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
  <div class="text-center mb-5">
    <div class="mb-4"><i class="fas fa-check-circle text-success" style="font-size:5rem"></i></div>
    <h1 class="fw-bold text-success">Commande confirmée !</h1>
    <p class="lead text-muted">Merci <?php echo e($order->shipping_first_name); ?> ! Votre commande a été passée avec succès.</p>
    <div class="badge bg-danger fs-5 px-4 py-2"><?php echo e($order->order_number); ?></div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-0 shadow mb-4">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Détails de la commande</h5>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
            <span><?php echo e($item->product_name); ?> × <?php echo e($item->quantity); ?></span>
            <span class="fw-bold"><?php echo e(number_format($item->total_price,3)); ?> TND</span>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="d-flex justify-content-between mt-2"><span>Livraison</span><span><?php echo e($order->shipping_cost > 0 ? number_format($order->shipping_cost,3).' TND' : 'Gratuite'); ?></span></div>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->discount > 0): ?><div class="d-flex justify-content-between text-success"><span>Réduction</span><span>-<?php echo e(number_format($order->discount,3)); ?> TND</span></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="d-flex justify-content-between fw-bold fs-5 mt-2 pt-2 border-top"><span>Total</span><span class="text-danger"><?php echo e(number_format($order->total,3)); ?> TND</span></div>
        </div>
      </div>
      <div class="card border-0 shadow mb-4">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Livraison à</h5>
          <p class="mb-1"><?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?></p>
          <p class="mb-1 text-muted"><?php echo e($order->shipping_address); ?></p>
          <p class="mb-1 text-muted"><?php echo e($order->shipping_city); ?><?php echo e($order->shipping_state ? ', '.$order->shipping_state : ''); ?></p>
          <p class="mb-0 text-muted">Tél: <?php echo e($order->shipping_phone); ?></p>
        </div>
      </div>
      <div class="d-flex gap-3 justify-content-center">
        <a href="<?php echo e(route('account.orders')); ?>" class="btn btn-outline-danger"><i class="fas fa-list me-1"></i>Mes commandes</a>
        <a href="<?php echo e(route('home')); ?>" class="btn btn-danger"><i class="fas fa-home me-1"></i>Retour à l'accueil</a>
        <a href="https://wa.me/21623136136?text=Bonjour, je viens de passer la commande <?php echo e($order->order_number); ?>" target="_blank" class="btn btn-success"><i class="fab fa-whatsapp me-1"></i>Contacter sur WhatsApp</a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/checkout/confirmation.blade.php ENDPATH**/ ?>