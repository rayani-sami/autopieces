<?php $__env->startSection('page-title','Tableau de bord'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-4">
  <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="d-flex align-items-center"><div class="flex-grow-1"><div class="text-muted small">Commandes aujourd'hui</div><div class="fs-2 fw-bold"><?php echo e($stats['orders_today']); ?></div></div><i class="fas fa-shopping-bag fa-2x text-danger opacity-50"></i></div></div></div></div>
  <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="d-flex align-items-center"><div class="flex-grow-1"><div class="text-muted small">CA ce mois (TND)</div><div class="fs-2 fw-bold"><?php echo e(number_format($stats['revenue_month'],3)); ?></div></div><i class="fas fa-money-bill-wave fa-2x text-success opacity-50"></i></div></div></div></div>
  <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="d-flex align-items-center"><div class="flex-grow-1"><div class="text-muted small">En attente</div><div class="fs-2 fw-bold text-warning"><?php echo e($stats['pending_orders']); ?></div></div><i class="fas fa-clock fa-2x text-warning opacity-50"></i></div></div></div></div>
  <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="d-flex align-items-center"><div class="flex-grow-1"><div class="text-muted small">Produits actifs</div><div class="fs-2 fw-bold"><?php echo e($stats['total_products']); ?></div></div><i class="fas fa-box fa-2x text-primary opacity-50"></i></div></div></div></div>
</div>
<div class="row g-3 mb-4">
  <div class="col-md-3"><div class="card border-0 shadow-sm bg-warning-subtle"><div class="card-body text-center"><div class="fw-bold fs-4 text-warning"><?php echo e($stats['low_stock']); ?></div><div class="small text-muted">Stock faible</div></div></div></div>
  <div class="col-md-3"><div class="card border-0 shadow-sm bg-info-subtle"><div class="card-body text-center"><div class="fw-bold fs-4 text-info"><?php echo e($stats['orders_month']); ?></div><div class="small text-muted">Commandes ce mois</div></div></div></div>
  <div class="col-md-3"><div class="card border-0 shadow-sm bg-success-subtle"><div class="card-body text-center"><div class="fw-bold fs-4 text-success"><?php echo e($stats['total_users']); ?></div><div class="small text-muted">Clients inscrits</div></div></div></div>
  <div class="col-md-3"><div class="card border-0 shadow-sm bg-primary-subtle"><div class="card-body text-center"><div class="fw-bold fs-4 text-primary"><?php echo e($stats['total_categories']); ?></div><div class="small text-muted">Catégories</div></div></div></div>
</div>
<div class="card border-0 shadow-sm">
  <div class="card-header bg-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-bold">Dernières commandes</h5>
    <a href="<?php echo e(route('admin.commandes.index')); ?>" class="btn btn-outline-danger btn-sm">Voir tout</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>N° Commande</th><th>Client</th><th>Date</th><th>Total</th><th>Statut</th><th>Action</th></tr></thead>
      <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><a href="<?php echo e(route('admin.commandes.show',$order)); ?>" class="fw-semibold text-danger"><?php echo e($order->order_number); ?></a></td>
          <td><?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?></td>
          <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
          <td class="fw-bold"><?php echo e(number_format($order->total,3)); ?> TND</td>
          <td><span class="badge bg-<?php echo e($order->status_color); ?>"><?php echo e($order->status_label); ?></span></td>
          <td><a href="<?php echo e(route('admin.commandes.show',$order)); ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>