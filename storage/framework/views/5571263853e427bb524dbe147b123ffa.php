<?php $__env->startSection('title','Mes Avis'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Mes avis</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<h4 class="fw-bold mb-4">Mes Avis</h4>

<div class="row g-4">
    <!-- Formulaire nouvel avis -->
    <div class="col-lg-4">
        <div class="card bh-card p-4">
            <h6 class="fw-bold mb-3"><i class="fa fa-star me-2 text-warning"></i>Donner un avis</h6>
            <form method="POST" action="<?php echo e(route('client.avis.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Offre concernée</label>
                    <select name="offre_id" class="form-select form-select-sm">
                        <option value="">— Général BH Bank —</option>
                        <?php $__currentLoopData = $offres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($offre->id); ?>"><?php echo e(Str::limit($offre->titre, 35)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Note *</label>
                    <div class="d-flex gap-2 fs-4">
                        <?php for($i=1; $i<=5; $i++): ?>
                        <label style="cursor:pointer" title="<?php echo e($i); ?> étoile(s)">
                            <input type="radio" name="note" value="<?php echo e($i); ?>" class="d-none" <?php echo e(old('note')==$i ? 'checked':''); ?> required>
                            <i class="fa fa-star star-icon" data-val="<?php echo e($i); ?>" style="color:#ddd;transition:color .15s"></i>
                        </label>
                        <?php endfor; ?>
                    </div>
                    <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Commentaire *</label>
                    <textarea name="commentaire" class="form-control <?php $__errorArgs = ['commentaire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        rows="4" placeholder="Partagez votre expérience..." required minlength="10"><?php echo e(old('commentaire')); ?></textarea>
                    <?php $__errorArgs = ['commentaire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button type="submit" class="btn btn-bh-primary w-100">
                    <i class="fa fa-paper-plane me-1"></i>Publier mon avis
                </button>
            </form>
        </div>
    </div>

    <!-- Liste avis -->
    <div class="col-lg-8">
        <?php $__empty_1 = true; $__currentLoopData = $avis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $av): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card bh-card mb-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <div class="bh-stars mb-1">
                            <?php for($i=1;$i<=5;$i++): ?>
                            <i class="fa fa-star<?php echo e($i <= $av->note ? '' : '-o'); ?>"></i>
                            <?php endfor; ?>
                            <span class="text-muted small ms-1">(<?php echo e($av->note); ?>/5)</span>
                        </div>
                        <?php if($av->offre): ?>
                        <div class="small text-muted"><i class="fa fa-tag me-1"></i><?php echo e($av->offre->titre); ?></div>
                        <?php else: ?>
                        <div class="small text-muted"><i class="fa fa-bank me-1"></i>Avis général</div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted small"><?php echo e($av->created_at->diffForHumans()); ?></span>
                        <a href="<?php echo e(route('client.avis.edit', $av)); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                </div>
                <p class="mb-0 small"><?php echo e($av->commentaire); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center py-5 text-muted">
            <i class="fa fa-star fa-3x mb-3 d-block" style="color:#ddd"></i>
            <p>Vous n'avez pas encore donné d'avis.</p>
        </div>
        <?php endif; ?>
        <?php if($avis->hasPages()): ?>
        <div><?php echo e($avis->links()); ?></div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
// Star rating interactive
document.querySelectorAll('.star-icon').forEach(function(star) {
    star.addEventListener('mouseover', function() {
        var val = parseInt(this.dataset.val);
        document.querySelectorAll('.star-icon').forEach(function(s) {
            s.style.color = parseInt(s.dataset.val) <= val ? 'var(--bh-gold)' : '#ddd';
        });
    });
    star.addEventListener('click', function() {
        var val = parseInt(this.dataset.val);
        document.querySelectorAll('input[name="note"]').forEach(function(inp) {
            inp.checked = parseInt(inp.value) === val;
        });
    });
    star.parentElement.parentElement.addEventListener('mouseleave', function() {
        var checked = document.querySelector('input[name="note"]:checked');
        var val = checked ? parseInt(checked.value) : 0;
        document.querySelectorAll('.star-icon').forEach(function(s) {
            s.style.color = parseInt(s.dataset.val) <= val ? 'var(--bh-gold)' : '#ddd';
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/client/avis/index.blade.php ENDPATH**/ ?>