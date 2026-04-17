<?php $__env->startSection('page-title','Produits'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between mb-3">
  <a href="<?php echo e(route('admin.produits.create')); ?>" class="btn btn-danger"><i class="fas fa-plus me-1"></i>Nouveau produit</a>
  <form method="GET" class="d-flex gap-2">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Nom, référence..." value="<?php echo e(request('search')); ?>">
    <select name="category" class="form-select form-select-sm" style="width:160px">
      <option value="">Catégorie</option>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c->id); ?>" <?php echo e(request('category')==$c->id?'selected':''); ?>><?php echo e($c->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </select>
    <button type="submit" class="btn btn-outline-secondary btn-sm">Filtrer</button>
  </form>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>Image</th><th>Nom</th><th>Catégorie</th><th>Réf.</th><th>Prix</th><th>Stock</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><img src="<?php echo e($product->thumbnail ? Storage::url($product->thumbnail) : ''); ?>" onerror="this.src=''" style="width:45px;height:45px;object-fit:contain;background:#f8f9fa" class="rounded"></td>
          <td><div class="fw-semibold small"><?php echo e(Str::limit($product->name,40)); ?></div><div class="text-muted" style="font-size:11px"><?php echo e($product->brand); ?></div></td>
          <td class="small"><?php echo e($product->category->name); ?></td>
          <td class="small text-muted"><?php echo e($product->reference); ?></td>
          <td class="fw-bold small"><?php echo e(number_format($product->price,3)); ?></td>
          <td><span class="badge bg-<?php echo e($product->stock>10?'success':($product->stock>0?'warning':'danger')); ?>"><?php echo e($product->stock); ?></span></td>
          <td><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->trashed()): ?><span class="badge bg-secondary">Archivé</span><?php elseif($product->is_active): ?><span class="badge bg-success">Actif</span><?php else: ?><span class="badge bg-warning">Inactif</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
          <td><a href="<?php echo e(route('admin.produits.edit',$product)); ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i></a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3"><?php echo e($products->withQueryString()->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/products/index.blade.php ENDPATH**/ ?>