<?php $__env->startSection('content'); ?>

<!-- Hero Slider -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banners->count()): ?>
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="carousel-item <?php echo e($i===0?'active':''); ?>">
      <img src="<?php echo e(Storage::url($banner->image)); ?>" class="d-block w-100" style="height:500px;object-fit:cover" alt="<?php echo e($banner->title); ?>">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banner->title): ?>
      <div class="carousel-caption d-none d-md-block">
        <h1 class="display-4 fw-bold"><?php echo e($banner->title); ?></h1>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banner->subtitle): ?><p class="lead"><?php echo e($banner->subtitle); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banner->link): ?><a href="<?php echo e($banner->link); ?>" class="btn btn-danger btn-lg"><?php echo e($banner->button_text ?? 'Voir'); ?></a><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banners->count()>1): ?>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php else: ?>
<!-- Default hero -->
<div class="hero-default bg-danger text-white py-5">
  <div class="container text-center py-4">
    <h1 class="display-4 fw-bold mb-3">Vos pièces auto sur AutoPart.tn</h1>
    <p class="lead mb-4">Sélectionnez votre véhicule et trouvez les pièces compatibles</p>
  </div>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<!-- Vehicle Search Section -->
<div class="container py-4">
  <div class="card shadow-sm border-0 bg-light">
    <div class="card-body p-4">
      <h3 class="fw-bold mb-4 text-center"><i class="fas fa-car text-danger me-2"></i>Sélectionnez votre véhicule</h3>
      <div class="row g-3">
        <div class="col-md-6">
          <h5 class="fw-semibold mb-3">Recherche par immatriculation</h5>
          <form action="<?php echo e(route('search.registration')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="input-group input-group-lg">
              <select name="plate_type" class="form-select flex-grow-0" style="width:90px">
                <option>TU</option><option>RS</option>
              </select>
              <input type="text" name="plate" class="form-control" placeholder="Numéro d'immatriculation" required>
              <button class="btn btn-danger px-4" type="submit"><i class="fas fa-search me-1"></i>Rechercher</button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <h5 class="fw-semibold mb-3">Ou par constructeur</h5>
          <div class="row g-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $makes->take(12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-4 col-md-3">
              <a href="<?php echo e(route('vehicle.models', $make->slug)); ?>" class="btn btn-outline-secondary btn-sm w-100 py-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($make->logo): ?><img src="<?php echo e(Storage::url($make->logo)); ?>" alt="<?php echo e($make->name); ?>" height="20" class="me-1"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php echo e($make->name); ?>

              </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Categories Grid -->
<div class="container pb-4">
  <h2 class="fw-bold mb-4">Catalogue pièces automobiles</h2>
  <div class="row g-3">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $rootCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-md-4 col-lg-2">
      <a href="<?php echo e(route('catalog.category', $cat->slug)); ?>" class="card text-center text-decoration-none border-0 shadow-sm h-100 category-card">
        <div class="card-body p-3">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cat->image): ?>
            <img src="<?php echo e(Storage::url($cat->image)); ?>" alt="<?php echo e($cat->name); ?>" class="mb-2" style="height:60px;object-fit:contain">
          <?php else: ?>
            <div class="category-icon mb-2"><i class="fas fa-cog fa-2x text-danger"></i></div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="fw-semibold small text-dark"><?php echo e($cat->name); ?></div>
        </div>
      </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>

<!-- Featured Products -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredProducts->count()): ?>
<div class="container pb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Produits populaires</h2>
    <a href="<?php echo e(route('search')); ?>" class="btn btn-outline-danger btn-sm">Voir tout</a>
  </div>
  <div class="row g-3">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-md-4 col-lg-3">
      <?php echo $__env->make('components.product-card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<!-- Makes brands strip -->
<div class="bg-light py-4 mb-4">
  <div class="container">
    <h3 class="fw-bold text-center mb-4">Constructeurs automobiles</h3>
    <div class="row g-2 justify-content-center">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-auto">
        <a href="<?php echo e(route('vehicle.models', $make->slug)); ?>" class="btn btn-white border shadow-sm px-3 py-2 text-dark"><?php echo e($make->name); ?></a>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
</div>

<!-- Why us -->
<div class="container pb-5">
  <div class="row g-4 text-center">
    <div class="col-md-3"><div class="py-3"><i class="fas fa-shipping-fast fa-2x text-danger mb-3"></i><h5 class="fw-bold">Livraison rapide</h5><p class="text-muted small">Partout en Tunisie en 24-48h</p></div></div>
    <div class="col-md-3"><div class="py-3"><i class="fas fa-shield-alt fa-2x text-success mb-3"></i><h5 class="fw-bold">Pièces garanties</h5><p class="text-muted small">Qualité origine vérifiée</p></div></div>
    <div class="col-md-3"><div class="py-3"><i class="fas fa-headset fa-2x text-primary mb-3"></i><h5 class="fw-bold">Support expert</h5><p class="text-muted small">Nos conseillers vous guident</p></div></div>
    <div class="col-md-3"><div class="py-3"><i class="fas fa-undo fa-2x text-warning mb-3"></i><h5 class="fw-bold">Retours faciles</h5><p class="text-muted small">30 jours pour changer d'avis</p></div></div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/home/index.blade.php ENDPATH**/ ?>