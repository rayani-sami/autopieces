<?php $__env->startSection('title','Modifier Agent'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.agents.index')); ?>">Agents</a></li>
    <li class="breadcrumb-item active">Modifier</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card bh-card p-4">
            <h5 class="fw-bold mb-4"><i class="fa fa-user-edit me-2 text-primary"></i>Modifier : <?php echo e($agent->nom_complet); ?></h5>
            <form method="POST" action="<?php echo e(route('admin.agents.update', $agent)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label fw-semibold">Prénom *</label>
                        <input type="text" name="prenom" class="form-control <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('prenom', $agent->prenom)); ?>" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Nom *</label>
                        <input type="text" name="nom" class="form-control" value="<?php echo e(old('nom', $agent->nom)); ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Email *</label>
                        <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email', $agent->email)); ?>" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="<?php echo e(old('telephone', $agent->telephone)); ?>">
                    </div>
                    <div class="col-12"><hr><p class="small text-muted">Laisser vide pour conserver le mot de passe actuel.</p></div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Confirmer</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-bh-primary px-4"><i class="fa fa-save me-1"></i>Enregistrer</button>
                    <a href="<?php echo e(route('admin.agents.index')); ?>" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/agents/edit.blade.php ENDPATH**/ ?>