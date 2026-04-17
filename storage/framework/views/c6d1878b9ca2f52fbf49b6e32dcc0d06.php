<?php $__env->startSection('page-title','Commande '.$order->order_number); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-4">
  <div class="col-md-8">
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Articles</h5>
        <a href="<?php echo e(route('admin.commandes.invoice',$order)); ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf me-1"></i>PDF</a>
      </div>
      <div class="table-responsive">
        <table class="table mb-0">
          <thead class="table-light"><tr><th>Produit</th><th>Réf.</th><th>Qté</th><th>Prix unit.</th><th>Total</th></tr></thead>
          <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr><td><?php echo e($item->product_name); ?></td><td class="text-muted small"><?php echo e($item->product_reference); ?></td><td><?php echo e($item->quantity); ?></td><td><?php echo e(number_format($item->unit_price,3)); ?></td><td class="fw-bold"><?php echo e(number_format($item->total_price,3)); ?></td></tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer bg-white">
        <div class="row justify-content-end">
          <div class="col-md-4">
            <div class="d-flex justify-content-between mb-1"><span class="text-muted">Sous-total</span><span><?php echo e(number_format($order->subtotal,3)); ?> TND</span></div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->discount > 0): ?><div class="d-flex justify-content-between mb-1 text-success"><span>Réduction</span><span>-<?php echo e(number_format($order->discount,3)); ?> TND</span></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="d-flex justify-content-between mb-1"><span class="text-muted">Livraison</span><span><?php echo e(number_format($order->shipping_cost,3)); ?> TND</span></div>
            <div class="d-flex justify-content-between fw-bold fs-5 pt-2 border-top"><span>Total</span><span class="text-danger"><?php echo e(number_format($order->total,3)); ?> TND</span></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Status update -->
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h5 class="fw-bold mb-3">Changer le statut</h5>
        <form action="<?php echo e(route('admin.commandes.status',$order)); ?>" method="POST" class="row g-2">
          <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
          <div class="col-md-4">
            <select name="status" class="form-select">
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Models\Order::STATUSES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($k); ?>" <?php echo e($order->status===$k?'selected':''); ?>><?php echo e($v['label']); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
          </div>
          <div class="col-md-6"><input type="text" name="comment" class="form-control" placeholder="Commentaire (optionnel)"></div>
          <div class="col-md-2"><button type="submit" class="btn btn-danger w-100">Mettre à jour</button></div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-body">
        <h6 class="fw-bold mb-3">Livraison</h6>
        <p class="mb-1 fw-semibold"><?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?></p>
        <p class="mb-1 text-muted small"><?php echo e($order->shipping_address); ?></p>
        <p class="mb-1 text-muted small"><?php echo e($order->shipping_city); ?><?php echo e($order->shipping_state ? ', '.$order->shipping_state : ''); ?></p>
        <p class="mb-0 text-muted small"><i class="fas fa-phone me-1"></i><?php echo e($order->shipping_phone); ?></p>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->notes): ?><div class="alert alert-info-subtle mt-2 p-2 small"><strong>Note:</strong> <?php echo e($order->notes); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    </div>
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="fw-bold mb-3">Historique</h6>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->statusHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex gap-2 mb-2">
          <div class="text-muted small text-nowrap"><?php echo e($h->created_at->format('d/m H:i')); ?></div>
          <div><span class="badge bg-secondary small"><?php echo e(\App\Models\Order::STATUSES[$h->status]['label'] ?? $h->status); ?></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($h->comment): ?><div class="text-muted" style="font-size:11px"><?php echo e($h->comment); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>