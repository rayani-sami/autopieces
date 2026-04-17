<?php $__env->startSection('page-title','Utilisateurs'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <form method="GET" class="d-flex gap-2">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Nom, email, téléphone..." value="<?php echo e(request('search')); ?>" style="width:250px">
    <select name="role" class="form-select form-select-sm" style="width:130px">
      <option value="">Tous rôles</option>
      <option value="admin" <?php echo e(request('role')==='admin'?'selected':''); ?>>Admin</option>
      <option value="manager" <?php echo e(request('role')==='manager'?'selected':''); ?>>Manager</option>
      <option value="client" <?php echo e(request('role')==='client'?'selected':''); ?>>Client</option>
    </select>
    <button type="submit" class="btn btn-outline-secondary btn-sm">Filtrer</button>
    <a href="<?php echo e(route('admin.utilisateurs.index')); ?>" class="btn btn-outline-secondary btn-sm">Reset</a>
  </form>
  <span class="text-muted small"><?php echo e($users->total()); ?> utilisateurs</span>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="table-light">
        <tr><th>Nom</th><th>Email</th><th>Téléphone</th><th>Rôle</th><th>Commandes</th><th>Statut</th><th>Inscrit le</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td class="fw-semibold"><?php echo e($user->full_name); ?></td>
          <td class="small"><?php echo e($user->email); ?></td>
          <td class="small"><?php echo e($user->phone ?: '-'); ?></td>
          <td>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <span class="badge bg-<?php echo e($role->name === 'admin' ? 'danger' : ($role->name === 'manager' ? 'warning' : 'secondary')); ?>"><?php echo e($role->name); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </td>
          <td><span class="badge bg-light text-dark border"><?php echo e($user->orders_count); ?></span></td>
          <td><span class="badge bg-<?php echo e($user->is_active ? 'success' : 'danger'); ?>"><?php echo e($user->is_active ? 'Actif' : 'Inactif'); ?></span></td>
          <td class="small text-muted"><?php echo e($user->created_at->format('d/m/Y')); ?></td>
          <td>
            <a href="<?php echo e(route('admin.utilisateurs.show', $user)); ?>" class="btn btn-outline-info btn-sm" title="Voir"><i class="fas fa-eye"></i></a>
            <a href="<?php echo e(route('admin.utilisateurs.edit', $user)); ?>" class="btn btn-outline-secondary btn-sm ms-1"><i class="fas fa-edit"></i></a>
            <form action="<?php echo e(route('admin.utilisateurs.toggle', $user)); ?>" method="POST" class="d-inline">
              <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
              <button type="submit" class="btn btn-outline-<?php echo e($user->is_active ? 'warning' : 'success'); ?> btn-sm ms-1" title="<?php echo e($user->is_active ? 'Désactiver' : 'Activer'); ?>">
                <i class="fas fa-<?php echo e($user->is_active ? 'ban' : 'check'); ?>"></i>
              </button>
            </form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="8" class="text-center text-muted py-4">Aucun utilisateur trouvé.</td></tr>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3"><?php echo e($users->withQueryString()->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/users/index.blade.php ENDPATH**/ ?>