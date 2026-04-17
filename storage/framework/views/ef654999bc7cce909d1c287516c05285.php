<?php $__env->startSection('title', 'Recherche' . ($query ? ': '.e($query) : '') . ' - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <!-- Search bar -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
      <form action="<?php echo e(route('search')); ?>" method="GET">
        <div class="input-group input-group-lg">
          <input type="text" name="q" class="form-control" placeholder="Nom de pièce, référence, marque..." value="<?php echo e(e($query)); ?>" autofocus>
          <button class="btn btn-danger px-4" type="submit"><i class="fas fa-search me-1"></i>Rechercher</button>
        </div>
      </form>
    </div>
  </div>

  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($query): ?>
  <div class="row g-4">
    <!-- Sidebar filters -->
    <div class="col-lg-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold mb-3"><i class="fas fa-filter text-danger me-2"></i>Affiner la recherche</h6>
          <form method="GET" action="<?php echo e(route('search')); ?>">
            <input type="hidden" name="q" value="<?php echo e(e($query)); ?>">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine): ?>
            <div class="alert alert-success-subtle p-2 mb-3 small border border-success-subtle">
              <i class="fas fa-car text-success me-1"></i>
              <strong><?php echo e($engine->carModel->make->name); ?> <?php echo e($engine->carModel->name); ?></strong>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categories->count()): ?>
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Catégorie</label>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category_id" value="<?php echo e($cat->id); ?>" id="cat<?php echo e($cat->id); ?>" <?php echo e(request('category_id') == $cat->id ? 'checked' : ''); ?>>
                <label class="form-check-label small" for="cat<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></label>
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
                <option value="relevance" <?php echo e(request('sort','relevance')==='relevance'?'selected':''); ?>>Pertinence</option>
                <option value="price_asc" <?php echo e(request('sort')==='price_asc'?'selected':''); ?>>Prix croissant</option>
                <option value="price_desc" <?php echo e(request('sort')==='price_desc'?'selected':''); ?>>Prix décroissant</option>
                <option value="newest" <?php echo e(request('sort')==='newest'?'selected':''); ?>>Plus récents</option>
              </select>
            </div>

            <button type="submit" class="btn btn-danger btn-sm w-100">Appliquer</button>
            <a href="<?php echo e(route('search', ['q' => $query])); ?>" class="btn btn-outline-secondary btn-sm w-100 mt-1">Réinitialiser filtres</a>
          </form>
        </div>
      </div>
    </div>

    <!-- Results -->
    <div class="col-lg-9">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h5 fw-bold mb-0">
          Résultats pour "<span class="text-danger"><?php echo e(e($query)); ?></span>"
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine): ?>
            <span class="badge bg-success ms-2 fw-normal small"><?php echo e($engine->carModel->make->name); ?> <?php echo e($engine->carModel->name); ?></span>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </h1>
        <span class="text-muted small"><?php echo e($products instanceof \Illuminate\Pagination\LengthAwarePaginator ? $products->total() : $products->count()); ?> résultat(s)</span>
      </div>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->count()): ?>
        <div class="row g-3">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-6 col-md-4">
            <?php echo $__env->make('components.product-card', compact('product'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
          <div class="mt-4"><?php echo e($products->links()); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <?php else: ?>
        <div class="text-center py-5">
          <i class="fas fa-search fa-4x text-muted mb-4"></i>
          <h4 class="text-muted">Aucun résultat pour "<?php echo e(e($query)); ?>"</h4>
          <p class="text-muted">Essayez avec des termes différents, une référence, ou parcourez notre catalogue.</p>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($engine): ?>
            <p class="text-muted small">Vous pouvez également <a href="<?php echo e(route('vehicle.clear')); ?>" class="text-danger">effacer le filtre véhicule</a> et relancer la recherche.</p>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <a href="<?php echo e(route('home')); ?>" class="btn btn-danger mt-2"><i class="fas fa-home me-1"></i>Retour à l'accueil</a>
        </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
  <?php else: ?>
  <!-- Empty state with suggestions -->
  <div class="row g-4">
    <div class="col-md-8 mx-auto text-center py-4">
      <i class="fas fa-search fa-4x text-muted mb-4"></i>
      <h3 class="text-muted mb-3">Que recherchez-vous ?</h3>
      <p class="text-muted">Saisissez le nom d'une pièce, une référence constructeur, ou une marque (Bosch, NGK, KYB...)</p>
    </div>
  </div>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
// Autocomplete
const searchInput = document.querySelector('input[name="q"]');
if (searchInput) {
  let timeout;
  searchInput.addEventListener('input', function() {
    clearTimeout(timeout);
    const q = this.value.trim();
    if (q.length < 2) return;
    timeout = setTimeout(() => {
      fetch(`<?php echo e(route('search')); ?>?q=${encodeURIComponent(q)}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(r => r.json())
      .then(data => { /* Could render dropdown */ })
      .catch(() => {});
    }, 300);
  });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/catalog/search.blade.php ENDPATH**/ ?>