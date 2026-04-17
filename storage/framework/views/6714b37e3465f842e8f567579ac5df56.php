<?php $__env->startSection('title','Mon Profil'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Mon profil</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card bh-card p-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bh-avatar"><?php echo e(strtoupper(substr($user->prenom,0,1))); ?></div>
                <div>
                    <h5 class="fw-bold mb-0"><?php echo e($user->nom_complet); ?></h5>
                    <p class="text-muted small mb-0"><?php echo e($user->email); ?></p>
                    <span class="badge bg-success mt-1">Client BH Bank</span>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('client.profil.update')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <h6 class="fw-bold text-muted text-uppercase small mb-3">Informations personnelles</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Prénom *</label>
                        <input type="text" name="prenom" class="form-control <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('prenom', $user->prenom)); ?>" required>
                        <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nom *</label>
                        <input type="text" name="nom" class="form-control"
                            value="<?php echo e(old('nom', $user->nom)); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Téléphone</label>
                        <input type="text" name="telephone" class="form-control"
                            value="<?php echo e(old('telephone', $user->telephone)); ?>" placeholder="+216 XX XXX XXX">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Photo de profil</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Adresse</label>
                        <input type="text" name="adresse" class="form-control"
                            value="<?php echo e(old('adresse', $user->adresse)); ?>" placeholder="Votre adresse">
                    </div>
                </div>

                <hr class="my-4">
                <h6 class="fw-bold text-muted text-uppercase small mb-3">Changer le mot de passe</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nouveau</label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 8 caractères">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Confirmer</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-bh-primary px-4 mt-4">
                    <i class="fa fa-save me-1"></i>Enregistrer les modifications
                </button>
            </form>

            <hr class="mt-4">
            <div class="row text-center">
                <div class="col-4">
                    <div class="fw-bold fs-5 text-primary"><?php echo e($user->reservationsClient()->count()); ?></div>
                    <div class="text-muted small">Réservations</div>
                </div>
                <div class="col-4">
                    <div class="fw-bold fs-5 text-success"><?php echo e($user->reservationsClient()->where('statut','accepte')->count()); ?></div>
                    <div class="text-muted small">Acceptées</div>
                </div>
                <div class="col-4">
                    <div class="fw-bold fs-5 text-warning"><?php echo e($user->avis()->count()); ?></div>
                    <div class="text-muted small">Avis publiés</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/client/profil/edit.blade.php ENDPATH**/ ?>