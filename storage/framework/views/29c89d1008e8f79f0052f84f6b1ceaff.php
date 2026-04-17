<?php $__env->startSection('title', $category->name . ' - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Accueil</a></li>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->parent): ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('catalog.category', $category->parent->slug)); ?>"><?php echo e($category->parent->name); ?></a></li>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <li class="breadcrumb-item active"><?php echo e($category->name); ?></li>
    </ol>
  </nav>

  <div class="row g-4">
    <!-- Sidebar Filters -->
    <div class="col-lg-3">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3"><i class="fas fa-filter text-danger me-2"></i>Filtres</h5>
          <form method="GET">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine): ?>
              <div class="alert alert-success-subtle border-success-subtle p-2 mb-3 small">
                <i class="fas fa-car text-success me-1"></i>
                <?php echo e($engine->carModel->make->name); ?> <?php echo e($engine->carModel->name); ?>

              </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($brands->count()): ?>
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Marque de pièce</label>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="brand" value="<?php echo e($brand); ?>" id="b<?php echo e(Str::slug($brand)); ?>" <?php echo e(request('brand')==$brand?'checked':''); ?>>
                <label class="form-check-label small" for="b<?php echo e(Str::slug($brand)); ?>"><?php echo e($brand); ?></label>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Prix (TND)</label>
              <div class="row g-1">
                <div class="col-6"><input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="<?php echo e(request('min_price')); ?>"></div>
                <div class="col-6"><input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="<?php echo e(request('max_price')); ?>"></div>
              </div>
            </div>
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Trier par</label>
              <select name="sort" class="form-select form-select-sm">
                <option value="default" <?php echo e(request('sort','default')==='default'?'selected':''); ?>>Par défaut</option>
                <option value="price_asc" <?php echo e(request('sort')==='price_asc'?'selected':''); ?>>Prix croissant</option>
                <option value="price_desc" <?php echo e(request('sort')==='price_desc'?'selected':''); ?>>Prix décroissant</option>
                <option value="newest" <?php echo e(request('sort')==='newest'?'selected':''); ?>>Plus récents</option>
              </select>
            </div>
            <button type="submit" class="btn btn-danger btn-sm w-100">Appliquer</button>
            <a href="<?php echo e(route('catalog.category', $category->slug)); ?>" class="btn btn-outline-secondary btn-sm w-100 mt-1">Réinitialiser</a>
          </form>
        </div>
      </div>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->children->count()): ?>
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold mb-2">Sous-catégories</h6>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('catalog.category', $child->slug)); ?>" class="d-block text-decoration-none text-dark py-1 border-bottom small hover-link"><?php echo e($child->name); ?></a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Products Grid -->
    <div class="col-lg-9">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 fw-bold mb-0"><?php echo e($category->name); ?></h1>
        <span class="text-muted small"><?php echo e($products->total()); ?> produits trouvés</span>
      </div>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$engine): ?>
      <div class="alert alert-info-subtle border-info-subtle small mb-3">
        <i class="fas fa-info-circle me-1"></i>Sélectionnez votre véhicule pour voir uniquement les pièces compatibles.
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->count()): ?>
      <div class="row g-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-4"><?php echo $__env->make('components.product-card', compact('product'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
      <div class="mt-4"><?php echo e($products->links()); ?></div>
      <?php else: ?>
      <div class="text-center py-5 text-muted">
        <i class="fas fa-search fa-3x mb-3"></i>
        <h5>Aucun produit trouvé</h5>
        <p>Essayez de modifier vos filtres ou <a href="<?php echo e(route('catalog.category', $category->slug)); ?>">réinitialisez</a> la recherche.</p>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/catalog/category.blade.php ENDPATH**/ ?>