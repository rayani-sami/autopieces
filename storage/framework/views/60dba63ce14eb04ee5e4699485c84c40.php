<?php $__env->startSection('title', 'Page introuvable'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5 text-center">
    <div class="py-5">
        <div style="font-size:100px;color:var(--bh-navy);opacity:.15;font-weight:900;line-height:1">404</div>
        <div class="bh-logo-circle mx-auto mb-4" style="width:70px;height:70px;margin-top:-30px">
            <i class="fa fa-search text-white" style="font-size:28px"></i>
        </div>
        <h2 class="fw-bold mb-2">Page introuvable</h2>
        <p class="text-muted mb-4">La page que vous recherchez n'existe pas ou a été déplacée.</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary px-4">
                <i class="fa fa-arrow-left me-2"></i>Retour
            </a>
            <a href="<?php echo e(route('home')); ?>" class="btn btn-bh-primary px-4">
                <i class="fa fa-home me-2"></i>Accueil
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/errors/404.blade.php ENDPATH**/ ?>