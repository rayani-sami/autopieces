<?php $__env->startSection('title', 'Offres & Catalogues'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-4" style="background:linear-gradient(135deg,var(--bh-navy),var(--bh-navy2));color:white">
    <div class="container">
        <h2 class="fw-bold mb-1"><i class="fa fa-tags me-2"></i>Offres & Catalogues</h2>
        <p class="text-white-50 mb-0">Découvrez toutes nos solutions bancaires BH Bank</p>
    </div>
</div>

<div class="container py-4">
    <!-- Filters -->
    <form method="GET" class="card border-0 shadow-sm p-3 mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Catégorie</label>
                <select name="categorie_id" class="form-select form-select-sm">
                    <option value="">Toutes les catégories</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e(request('categorie_id') == $cat->id ? 'selected' : ''); ?>>
                        <?php echo e($cat->nom); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-auto">
                <button class="btn btn-bh-primary btn-sm px-4">
                    <i class="fa fa-filter me-1"></i>Filtrer
                </button>
                <a href="<?php echo e(route('visitor.offres')); ?>" class="btn btn-outline-secondary btn-sm ms-1">
                    <i class="fa fa-times me-1"></i>Réinitialiser
                </a>
            </div>
        </div>
    </form>

    <!-- Results -->
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $offres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-lg-4">
            <div class="offre-card card h-100">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa <?php echo e($offre->categorie->icone ?? 'fa-tag'); ?> fs-5"></i>
                            <div>
                                <div class="fw-bold small"><?php echo e($offre->titre); ?></div>
                                <?php if($offre->categorie): ?>
                                <div class="opacity-75" style="font-size:11px"><?php echo e($offre->categorie->nom); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if($offre->avis->count()): ?>
                        <div class="text-end">
                            <div class="bh-stars small">
                                <i class="fa fa-star"></i>
                                <?php echo e(number_format($offre->avis->avg('note'), 1)); ?>

                            </div>
                            <div style="font-size:10px;opacity:.7"><?php echo e($offre->avis->count()); ?> avis</div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3"><?php echo e(Str::limit($offre->description, 140)); ?></p>
                    <div class="row g-2">
                        <?php if($offre->taux_interet): ?>
                        <div class="col-6">
                            <div class="rounded p-2 text-center" style="background:#f0f7ff">
                                <div class="fw-bold text-primary"><?php echo e($offre->taux_interet); ?>%</div>
                                <div class="small text-muted" style="font-size:11px">Taux d'intérêt</div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($offre->duree_mois): ?>
                        <div class="col-6">
                            <div class="rounded p-2 text-center" style="background:#f0fdf4">
                                <div class="fw-bold text-success"><?php echo e($offre->duree_mois); ?> mois</div>
                                <div class="small text-muted" style="font-size:11px">Durée max.</div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($offre->montant_min): ?>
                        <div class="col-6">
                            <div class="rounded p-2 text-center" style="background:#fffbeb">
                                <div class="fw-bold text-warning"><?php echo e(number_format($offre->montant_min,0,',','.')); ?> DT</div>
                                <div class="small text-muted" style="font-size:11px">Montant min.</div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($offre->montant_max): ?>
                        <div class="col-6">
                            <div class="rounded p-2 text-center" style="background:#fdf4ff">
                                <div class="fw-bold text-purple"><?php echo e(number_format($offre->montant_max,0,',','.')); ?> DT</div>
                                <div class="small text-muted" style="font-size:11px">Montant max.</div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if($offre->date_fin): ?>
                    <div class="mt-2 text-muted small">
                        <i class="fa fa-calendar-times me-1 text-danger"></i>
                        Expire le <?php echo e($offre->date_fin->format('d/m/Y')); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer bg-transparent d-flex gap-2">
                    <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('client.reservations.create')); ?>" class="btn btn-bh-primary btn-sm flex-grow-1">
                        <i class="fa fa-calendar-plus me-1"></i>Prendre RDV
                    </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-bh-primary btn-sm flex-grow-1">
                        <i class="fa fa-sign-in-alt me-1"></i>S'inscrire
                    </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('visitor.chatbot')); ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-robot"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center py-5">
            <i class="fa fa-tags fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Aucune offre disponible pour cette catégorie</h5>
        </div>
        <?php endif; ?>
    </div>

    <div class="mt-4"><?php echo e($offres->appends(request()->query())->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/visitor/offres.blade.php ENDPATH**/ ?>