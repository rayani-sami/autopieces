<div class="card h-100 border-0 shadow-sm product-card">
  <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="text-decoration-none">
    <div class="product-img-wrap bg-light" style="height:180px;overflow:hidden">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->thumbnail): ?>
        <img src="<?php echo e(Storage::url($product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>" class="card-img-top" style="height:180px;object-fit:contain;padding:10px">
      <?php else: ?>
        <div class="d-flex align-items-center justify-content-center h-100 text-muted"><i class="fas fa-image fa-3x"></i></div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </a>
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->discount_percent): ?>
    <span class="badge bg-danger position-absolute top-0 end-0 m-2">-<?php echo e($product->discount_percent); ?>%</span>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_new): ?>
    <span class="badge bg-success position-absolute top-0 start-0 m-2">Nouveau</span>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  <div class="card-body p-3">
    <div class="text-muted small mb-1"><?php echo e($product->brand); ?></div>
    <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="text-decoration-none text-dark">
      <h6 class="card-title fw-semibold mb-1" style="font-size:13px;line-height:1.3"><?php echo e(Str::limit($product->name,60)); ?></h6>
    </a>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->reference): ?>
      <div class="text-muted" style="font-size:11px">Réf: <?php echo e($product->reference); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="mt-2 d-flex align-items-center justify-content-between">
      <div>
        <span class="fw-bold text-danger fs-6"><?php echo e(number_format($product->price,3)); ?> TND</span>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->price_old): ?><br><small class="text-muted text-decoration-line-through"><?php echo e(number_format($product->price_old,3)); ?> TND</small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_in_stock): ?>
        <span class="badge bg-success-subtle text-success small">En stock</span>
      <?php else: ?>
        <span class="badge bg-danger-subtle text-danger small">Rupture</span>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_in_stock): ?>
    <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="mt-2">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
      <input type="hidden" name="quantity" value="1">
      <button type="submit" class="btn btn-danger btn-sm w-100"><i class="fas fa-cart-plus me-1"></i>Ajouter au panier</button>
    </form>
    <?php else: ?>
      <button class="btn btn-secondary btn-sm w-100 mt-2" disabled>Indisponible</button>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/components/product-card.blade.php ENDPATH**/ ?>