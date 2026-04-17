<?php $__env->startSection('page-title','Paramètres'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-4">
  <div class="col-md-6">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h5 class="fw-bold mb-3">Informations du site</h5>
        <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="mb-3"><label class="fw-semibold small">Nom du site</label><input type="text" name="site_name" class="form-control" value="<?php echo e($settings['site_name']??'AutoPart'); ?>"></div>
          <div class="mb-3"><label class="fw-semibold small">Téléphone</label><input type="text" name="site_phone" class="form-control" value="<?php echo e($settings['site_phone']??''); ?>"></div>
          <div class="mb-3"><label class="fw-semibold small">Email</label><input type="email" name="site_email" class="form-control" value="<?php echo e($settings['site_email']??''); ?>"></div>
          <div class="mb-3"><label class="fw-semibold small">Adresse</label><textarea name="site_address" class="form-control" rows="2"><?php echo e($settings['site_address']??''); ?></textarea></div>
          <hr>
          <h6 class="fw-bold mb-2">Frais de livraison</h6>
          <div class="row g-2">
            <div class="col-md-4"><label class="small">Livraison gratuite dès (TND)</label><input type="number" name="shipping_free_above" class="form-control form-control-sm" value="<?php echo e($settings['shipping_free_above']??200); ?>"></div>
            <div class="col-md-4"><label class="small">Grand Tunis (TND)</label><input type="number" name="shipping_tunis" class="form-control form-control-sm" value="<?php echo e($settings['shipping_tunis']??8); ?>"></div>
            <div class="col-md-4"><label class="small">Autres régions (TND)</label><input type="number" name="shipping_other" class="form-control form-control-sm" value="<?php echo e($settings['shipping_other']??12); ?>"></div>
          </div>
          <button type="submit" class="btn btn-danger mt-3">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
          <h5 class="fw-bold mb-0">Bannières</h5>
        </div>
        <form action="<?php echo e(route('admin.bannieres.store')); ?>" method="POST" enctype="multipart/form-data" class="mb-4">
          <?php echo csrf_field(); ?>
          <div class="row g-2">
            <div class="col-12"><input type="file" name="image" class="form-control form-control-sm" accept="image/*" required></div>
            <div class="col-6"><input type="text" name="title" class="form-control form-control-sm" placeholder="Titre"></div>
            <div class="col-6"><input type="text" name="subtitle" class="form-control form-control-sm" placeholder="Sous-titre"></div>
            <div class="col-6"><input type="text" name="link" class="form-control form-control-sm" placeholder="Lien (optionnel)"></div>
            <div class="col-6"><input type="text" name="button_text" class="form-control form-control-sm" placeholder="Texte du bouton"></div>
            <div class="col-12"><button type="submit" class="btn btn-danger btn-sm w-100">Ajouter la bannière</button></div>
          </div>
        </form>
        <div class="row g-2">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-12 d-flex align-items-center gap-2 border-bottom pb-2">
            <img src="<?php echo e(Storage::url($banner->image)); ?>" style="height:50px;width:80px;object-fit:cover" class="rounded">
            <div class="flex-grow-1 small"><div class="fw-semibold"><?php echo e($banner->title ?: '(sans titre)'); ?></div><div class="text-muted"><?php echo e($banner->link); ?></div></div>
            <form action="<?php echo e(route('admin.bannieres.destroy',$banner)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer ?')"><i class="fas fa-trash"></i></button></form>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>