<?php $__env->startSection('title','Mon compte - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <h1 class="fw-bold mb-4">Mon compte</h1>
  <div class="row g-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center p-4">
          <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px;font-size:1.5rem"><?php echo e(strtoupper(substr($user->first_name,0,1))); ?></div>
          <h6 class="fw-bold mb-0"><?php echo e($user->full_name); ?></h6>
          <div class="text-muted small"><?php echo e($user->email); ?></div>
        </div>
        <div class="list-group list-group-flush">
          <a href="<?php echo e(route('account.index')); ?>" class="list-group-item list-group-item-action <?php echo e(request()->routeIs('account.index')?'active':''); ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
          <a href="<?php echo e(route('account.orders')); ?>" class="list-group-item list-group-item-action <?php echo e(request()->routeIs('account.orders*')?'active':''); ?>"><i class="fas fa-shopping-bag me-2"></i>Mes commandes</a>
          <a href="<?php echo e(route('account.addresses')); ?>" class="list-group-item list-group-item-action <?php echo e(request()->routeIs('account.addresses*')?'active':''); ?>"><i class="fas fa-map-marker-alt me-2"></i>Mes adresses</a>
          <a href="<?php echo e(route('account.vehicles')); ?>" class="list-group-item list-group-item-action <?php echo e(request()->routeIs('account.vehicles*')?'active':''); ?>"><i class="fas fa-car me-2"></i>Mes véhicules</a>
          <a href="<?php echo e(route('account.profile')); ?>" class="list-group-item list-group-item-action <?php echo e(request()->routeIs('account.profile*')?'active':''); ?>"><i class="fas fa-user me-2"></i>Mon profil</a>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="card border-0 shadow-sm text-center p-3"><div class="fs-2 fw-bold text-danger"><?php echo e($user->orders->count()); ?></div><div class="text-muted small">Commandes</div></div></div>
        <div class="col-md-4"><div class="card border-0 shadow-sm text-center p-3"><div class="fs-2 fw-bold text-success"><?php echo e($user->orders->where('status','delivered')->count()); ?></div><div class="text-muted small">Livrées</div></div></div>
        <div class="col-md-4"><div class="card border-0 shadow-sm text-center p-3"><div class="fs-2 fw-bold text-warning"><?php echo e($user->orders->where('status','pending')->count()); ?></div><div class="text-muted small">En attente</div></div></div>
      </div>
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Dernières commandes</h5>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $user->orders->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
            <div>
              <a href="<?php echo e(route('account.order.detail',$order)); ?>" class="text-decoration-none fw-semibold"><?php echo e($order->order_number); ?></a>
              <div class="text-muted small"><?php echo e($order->created_at->format('d/m/Y')); ?> · <?php echo e($order->items->count()); ?> article(s)</div>
            </div>
            <div class="text-end">
              <span class="badge bg-<?php echo e($order->status_color); ?>"><?php echo e($order->status_label); ?></span>
              <div class="fw-bold mt-1"><?php echo e(number_format($order->total,3)); ?> TND</div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <p class="text-muted">Aucune commande pour le moment.</p>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <a href="<?php echo e(route('account.orders')); ?>" class="btn btn-outline-danger btn-sm mt-3">Voir toutes mes commandes</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/account/index.blade.php ENDPATH**/ ?>