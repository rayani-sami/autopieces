<?php $__env->startSection('page-title','Modifier: '.Str::limit($produit->name, 40)); ?>
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.produits.update', $produit)); ?>" method="POST" enctype="multipart/form-data">
  <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
  <div class="row g-4">
    <div class="col-md-8">
      <!-- General Info -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Informations générales</h5></div>
        <div class="card-body">
          <div class="mb-3">
            <label class="fw-semibold small">Nom du produit *</label>
            <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($produit->name); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="fw-semibold small">Catégorie *</label>
              <select name="category_id" class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">Choisir...</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($c->id); ?>" <?php echo e($produit->category_id == $c->id ? 'selected' : ''); ?>>
                    <?php echo e($c->parent ? $c->parent->name . ' › ' : ''); ?><?php echo e($c->name); ?>

                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="fw-semibold small">Marque de pièce</label>
              <input type="text" name="brand" class="form-control" value="<?php echo e($produit->brand); ?>" placeholder="Bosch, NGK, KYB...">
            </div>
            <div class="col-md-6">
              <label class="fw-semibold small">Référence</label>
              <input type="text" name="reference" class="form-control" value="<?php echo e($produit->reference); ?>">
            </div>
            <div class="col-md-6">
              <label class="fw-semibold small">Référence OEM</label>
              <input type="text" name="oem_reference" class="form-control" value="<?php echo e($produit->oem_reference); ?>">
            </div>
          </div>
          <div class="mt-3">
            <label class="fw-semibold small">Description</label>
            <textarea name="description" class="form-control" rows="5"><?php echo e($produit->description); ?></textarea>
          </div>
          <div class="mt-3">
            <label class="fw-semibold small">Spécifications techniques</label>
            <textarea name="technical_specs" class="form-control" rows="3" placeholder="Dimensions, poids, normes..."><?php echo e($produit->technical_specs); ?></textarea>
          </div>
        </div>
      </div>

      <!-- Images gallery -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Galerie d'images</h5></div>
        <div class="card-body">
          <div class="row g-2 mb-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-3">
              <div class="position-relative border rounded p-1" style="background:#f8f9fa">
                <img src="<?php echo e(Storage::url($img->path)); ?>" style="width:100%;height:90px;object-fit:contain" alt="Image">
                <form action="<?php echo e(route('admin.produits.images.delete', $img)); ?>" method="POST">
                  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 py-0 px-1" onclick="return confirm('Supprimer cette image ?')" style="font-size:10px">✕</button>
                </form>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($images->isEmpty()): ?>
              <div class="col-12 text-muted small">Aucune image en galerie.</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
          <form action="<?php echo e(route('admin.produits.images.upload', $produit)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="input-group">
              <input type="file" name="image" class="form-control form-control-sm" accept="image/*" required>
              <button type="submit" class="btn btn-outline-danger btn-sm">Ajouter image</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <!-- Price & Stock -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Prix & Stock</h5></div>
        <div class="card-body">
          <div class="mb-3">
            <label class="fw-semibold small">Prix (TND) *</label>
            <input type="number" name="price" step="0.001" min="0" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($produit->price); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
          <div class="mb-3">
            <label class="fw-semibold small">Ancien prix (TND) <span class="text-muted small">pour barré</span></label>
            <input type="number" name="price_old" step="0.001" min="0" class="form-control" value="<?php echo e($produit->price_old); ?>">
          </div>
          <div class="mb-3">
            <label class="fw-semibold small">Stock *</label>
            <input type="number" name="stock" min="0" class="form-control <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($produit->stock); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Thumbnail -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Image principale</h5></div>
        <div class="card-body">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($produit->thumbnail): ?>
            <div class="text-center mb-2 p-2" style="background:#f8f9fa;border-radius:8px">
              <img src="<?php echo e(Storage::url($produit->thumbnail)); ?>" style="max-height:100px;max-width:100%;object-fit:contain" alt="Thumbnail">
            </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <input type="file" name="thumbnail" class="form-control form-control-sm" accept="image/*">
          <div class="text-muted small mt-1">Format recommandé: 600×600px JPG/PNG/WebP</div>
        </div>
      </div>

      <!-- Options -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Options</h5></div>
        <div class="card-body">
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php echo e($produit->is_active ? 'checked' : ''); ?>>
            <label class="form-check-label" for="is_active">Actif (visible sur le site)</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" <?php echo e($produit->is_featured ? 'checked' : ''); ?>>
            <label class="form-check-label" for="is_featured">En vedette (page d'accueil)</label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_new" value="1" id="is_new" <?php echo e($produit->is_new ? 'checked' : ''); ?>>
            <label class="form-check-label" for="is_new">Badge "Nouveau"</label>
          </div>
          <div>
            <label class="fw-semibold small">Ordre d'affichage</label>
            <input type="number" name="sort_order" class="form-control form-control-sm" value="<?php echo e($produit->sort_order); ?>">
          </div>
        </div>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-danger fw-bold py-2">
          <i class="fas fa-save me-1"></i>Enregistrer les modifications
        </button>
        <a href="<?php echo e(route('admin.produits.index')); ?>" class="btn btn-outline-secondary">Annuler</a>
        <form action="<?php echo e(route('admin.produits.destroy', $produit)); ?>" method="POST">
          <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
          <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Archiver ce produit ?')">
            <i class="fas fa-archive me-1"></i>Archiver le produit
          </button>
        </form>
      </div>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>