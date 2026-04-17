<?php $__env->startSection('page-title','Catégories'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between mb-3">
  <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-danger"><i class="fas fa-plus me-1"></i>Nouvelle catégorie</a>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>Image</th><th>Nom</th><th>Parent</th><th>Produits</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cat->image): ?><img src="<?php echo e(Storage::url($cat->image)); ?>" style="height:35px;width:35px;object-fit:contain;background:#f8f9fa" class="rounded"><?php else: ?><i class="fas fa-folder text-muted"></i><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
          <td><span class="<?php echo e(!$cat->parent_id ? 'fw-bold' : 'ms-3 text-muted'); ?>"><?php echo e(!$cat->parent_id ? '' : '↳ '); ?><?php echo e($cat->name); ?></span></td>
          <td class="small text-muted"><?php echo e($cat->parent?->name); ?></td>
          <td><span class="badge bg-light text-dark border"><?php echo e($cat->products->count()); ?></span></td>
          <td><span class="badge bg-<?php echo e($cat->is_active?'success':'secondary'); ?>"><?php echo e($cat->is_active?'Actif':'Inactif'); ?></span></td>
          <td>
            <a href="<?php echo e(route('admin.categories.edit',$cat)); ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i></a>
            <form action="<?php echo e(route('admin.categories.destroy',$cat)); ?>" method="POST" class="d-inline"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-outline-danger btn-sm ms-1" onclick="return confirm('Supprimer ?')"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>