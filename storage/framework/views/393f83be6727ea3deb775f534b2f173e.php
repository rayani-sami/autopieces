<?php $__env->startSection('page-title','Commandes'); ?>
<?php $__env->startSection('content'); ?>
<div class="card border-0 shadow-sm mb-3">
  <div class="card-body">
    <form method="GET" class="row g-2 align-items-end">
      <div class="col-md-3"><input type="text" name="search" class="form-control form-control-sm" placeholder="N° commande ou email..." value="<?php echo e(request('search')); ?>"></div>
      <div class="col-md-2">
        <select name="status" class="form-select form-select-sm">
          <option value="">Tous les statuts</option>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Models\Order::STATUSES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($k); ?>" <?php echo e(request('status')===$k?'selected':''); ?>><?php echo e($v['label']); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>
      </div>
      <div class="col-md-2"><input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo e(request('date_from')); ?>"></div>
      <div class="col-md-2"><input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo e(request('date_to')); ?>"></div>
      <div class="col-md-2"><button type="submit" class="btn btn-danger btn-sm w-100">Filtrer</button></div>
      <div class="col-md-1"><a href="<?php echo e(route('admin.commandes.index')); ?>" class="btn btn-outline-secondary btn-sm w-100">Reset</a></div>
    </form>
  </div>
</div>
<!-- Status tabs -->
<div class="d-flex gap-2 mb-3 flex-wrap">
  <a href="<?php echo e(route('admin.commandes.index')); ?>" class="btn btn-<?php echo e(!request('status')?'danger':'outline-secondary'); ?> btn-sm">Tout (<?php echo e($statusCounts->sum()); ?>)</a>
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Models\Order::STATUSES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a href="<?php echo e(route('admin.commandes.index',['status'=>$k])); ?>" class="btn btn-<?php echo e(request('status')===$k?'danger':'outline-secondary'); ?> btn-sm"><?php echo e($v['label']); ?> (<?php echo e($statusCounts[$k]??0); ?>)</a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>N° Commande</th><th>Client</th><th>Ville</th><th>Date</th><th>Total</th><th>Paiement</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><a href="<?php echo e(route('admin.commandes.show',$order)); ?>" class="fw-semibold text-danger"><?php echo e($order->order_number); ?></a></td>
          <td><div class="fw-semibold"><?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?></div><div class="text-muted small"><?php echo e($order->shipping_phone); ?></div></td>
          <td><?php echo e($order->shipping_city); ?></td>
          <td><?php echo e($order->created_at->format('d/m/Y')); ?></td>
          <td class="fw-bold"><?php echo e(number_format($order->total,3)); ?></td>
          <td><span class="badge bg-<?php echo e($order->payment_method==='bank_transfer'?'info':'secondary'); ?> small"><?php echo e($order->payment_method==='cash_on_delivery'?'À la livraison':'Virement'); ?></span></td>
          <td><span class="badge bg-<?php echo e($order->status_color); ?>"><?php echo e($order->status_label); ?></span></td>
          <td><a href="<?php echo e(route('admin.commandes.show',$order)); ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a><a href="<?php echo e(route('admin.commandes.invoice',$order)); ?>" class="btn btn-outline-primary btn-sm ms-1"><i class="fas fa-file-pdf"></i></a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3"><?php echo e($orders->withQueryString()->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>