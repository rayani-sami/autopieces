<?php $__env->startSection('title','Mon panier - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <h1 class="fw-bold mb-4"><i class="fas fa-shopping-cart text-danger me-2"></i>Mon panier</h1>
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cart->items->count()): ?>
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="d-flex align-items-center p-3 border-bottom cart-item" id="item-<?php echo e($item->id); ?>">
            <a href="<?php echo e(route('product.show', $item->product->slug)); ?>">
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product->thumbnail): ?>
                <img src="<?php echo e(Storage::url($item->product->thumbnail)); ?>" alt="<?php echo e($item->product->name); ?>" style="width:80px;height:80px;object-fit:contain;background:#f8f9fa" class="rounded me-3">
              <?php else: ?>
                <div style="width:80px;height:80px;background:#f8f9fa" class="rounded me-3 d-flex align-items-center justify-content-center"><i class="fas fa-image text-muted"></i></div>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>
            <div class="flex-grow-1">
              <a href="<?php echo e(route('product.show', $item->product->slug)); ?>" class="text-decoration-none text-dark fw-semibold"><?php echo e($item->product->name); ?></a>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product->reference): ?><div class="text-muted small">Réf: <?php echo e($item->product->reference); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
              <div class="text-danger fw-bold"><?php echo e(number_format($item->price,3)); ?> TND</div>
            </div>
            <div class="d-flex align-items-center gap-2">
              <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST" class="d-flex align-items-center gap-1">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <button type="submit" name="quantity" value="<?php echo e($item->quantity-1); ?>" class="btn btn-outline-secondary btn-sm">-</button>
                <span class="px-2 fw-bold"><?php echo e($item->quantity); ?></span>
                <button type="submit" name="quantity" value="<?php echo e($item->quantity+1); ?>" class="btn btn-outline-secondary btn-sm">+</button>
              </form>
              <div class="fw-bold ms-2 text-nowrap"><?php echo e(number_format($item->subtotal,3)); ?> TND</div>
              <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-outline-danger btn-sm ms-2"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Résumé de commande</h5>
          <div class="d-flex justify-content-between mb-2"><span class="text-muted">Sous-total</span><span><?php echo e(number_format($cart->total,3)); ?> TND</span></div>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($coupon) && $coupon): ?>
          <div class="d-flex justify-content-between mb-2 text-success"><span>Réduction (<?php echo e($coupon['code']); ?>)</span><span>-<?php echo e(number_format($coupon['discount'],3)); ?> TND</span></div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="d-flex justify-content-between mb-3"><span class="text-muted">Livraison</span><span class="text-muted small">Calculée à la commande</span></div>
          <hr>
          <div class="d-flex justify-content-between fw-bold fs-5 mb-3"><span>Total</span><span class="text-danger"><?php echo e(number_format($cart->total - ($coupon['discount']??0),3)); ?> TND</span></div>
          <a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-danger w-100 py-2 fw-bold"><i class="fas fa-credit-card me-2"></i>Passer la commande</a>
          <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary w-100 mt-2">Continuer mes achats</a>
        </div>
      </div>
      <!-- Coupon -->
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold mb-2">Code promo</h6>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($coupon) && $coupon): ?>
            <div class="alert alert-success-subtle py-2 d-flex justify-content-between align-items-center">
              <span><strong><?php echo e($coupon['code']); ?></strong> (-<?php echo e(number_format($coupon['discount'],3)); ?> TND)</span>
              <form action="<?php echo e(route('cart.coupon.remove')); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-sm btn-outline-danger">×</button></form>
            </div>
          <?php else: ?>
            <form action="<?php echo e(route('cart.coupon')); ?>" method="POST" class="d-flex gap-1">
              <?php echo csrf_field(); ?>
              <input type="text" name="coupon_code" class="form-control form-control-sm" placeholder="Code promo">
              <button type="submit" class="btn btn-outline-danger btn-sm">Appliquer</button>
            </form>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php else: ?>
  <div class="text-center py-5">
    <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
    <h3 class="text-muted">Votre panier est vide</h3>
    <a href="<?php echo e(route('home')); ?>" class="btn btn-danger mt-3"><i class="fas fa-arrow-left me-2"></i>Continuer mes achats</a>
  </div>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/cart/index.blade.php ENDPATH**/ ?>