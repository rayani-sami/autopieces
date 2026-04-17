<?php $__env->startSection('page-title','Nouveau produit'); ?>
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.produits.store')); ?>" method="POST" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <div class="row g-4">
    <div class="col-md-8">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Informations générales</h5>
          <div class="mb-3"><label class="fw-semibold small">Nom du produit *</label><input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name')); ?>" required><div class="invalid-feedback"><?php echo e($errors->first('name')); ?></div></div>
          <div class="row g-3">
            <div class="col-md-6"><label class="fw-semibold small">Catégorie *</label><select name="category_id" class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><option value="">Choisir...</option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c->id); ?>" <?php echo e(old('category_id')==$c->id?'selected':''); ?>><?php echo e($c->parent?$c->parent->name.' > ':''); ?><?php echo e($c->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></select></div>
            <div class="col-md-6"><label class="fw-semibold small">Marque de pièce</label><input type="text" name="brand" class="form-control" value="<?php echo e(old('brand')); ?>" placeholder="Bosch, NGK, KYB..."></div>
            <div class="col-md-6"><label class="fw-semibold small">Référence</label><input type="text" name="reference" class="form-control" value="<?php echo e(old('reference')); ?>"></div>
            <div class="col-md-6"><label class="fw-semibold small">Référence OEM</label><input type="text" name="oem_reference" class="form-control" value="<?php echo e(old('oem_reference')); ?>"></div>
          </div>
          <div class="mt-3"><label class="fw-semibold small">Description</label><textarea name="description" class="form-control" rows="4"><?php echo e(old('description')); ?></textarea></div>
          <div class="mt-3"><label class="fw-semibold small">Spécifications techniques</label><textarea name="technical_specs" class="form-control" rows="3" placeholder="Dimensions, poids, normes..."><?php echo e(old('technical_specs')); ?></textarea></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Prix & Stock</h5>
          <div class="mb-3"><label class="fw-semibold small">Prix (TND) *</label><input type="number" name="price" step="0.001" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('price')); ?>" required></div>
          <div class="mb-3"><label class="fw-semibold small">Ancien prix (TND)</label><input type="number" name="price_old" step="0.001" class="form-control" value="<?php echo e(old('price_old')); ?>"></div>
          <div class="mb-3"><label class="fw-semibold small">Stock *</label><input type="number" name="stock" class="form-control <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('stock',0)); ?>" required></div>
        </div>
      </div>
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Image principale</h5>
          <input type="file" name="thumbnail" class="form-control" accept="image/*">
        </div>
      </div>
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Options</h5>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked><label class="form-check-label" for="is_active">Actif</label></div>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"><label class="form-check-label" for="is_featured">En vedette</label></div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="is_new" value="1" id="is_new"><label class="form-check-label" for="is_new">Nouveau</label></div>
          <div class="mt-3"><label class="fw-semibold small">Ordre d'affichage</label><input type="number" name="sort_order" class="form-control form-control-sm" value="0"></div>
        </div>
      </div>
      <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">Créer le produit</button>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/products/create.blade.php ENDPATH**/ ?>