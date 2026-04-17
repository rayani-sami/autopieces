<?php $__env->startSection('title','Inscription - AutoPart'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card border-0 shadow">
        <div class="card-body p-4">
          <h4 class="fw-bold text-center mb-4">Créer un compte</h4>
          <form action="<?php echo e(route('register')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row g-3">
              <div class="col-md-6"><label class="fw-semibold small">Prénom *</label><input type="text" name="first_name" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('first_name')); ?>" required><div class="invalid-feedback"><?php echo e($errors->first('first_name')); ?></div></div>
              <div class="col-md-6"><label class="fw-semibold small">Nom *</label><input type="text" name="last_name" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('last_name')); ?>" required><div class="invalid-feedback"><?php echo e($errors->first('last_name')); ?></div></div>
              <div class="col-12"><label class="fw-semibold small">Email *</label><input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required><div class="invalid-feedback"><?php echo e($errors->first('email')); ?></div></div>
              <div class="col-12"><label class="fw-semibold small">Téléphone</label><input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>"></div>
              <div class="col-12"><label class="fw-semibold small">Mot de passe *</label><input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><div class="invalid-feedback"><?php echo e($errors->first('password')); ?></div></div>
              <div class="col-12"><label class="fw-semibold small">Confirmer le mot de passe *</label><input type="password" name="password_confirmation" class="form-control" required></div>
            </div>
            <button type="submit" class="btn btn-danger w-100 py-2 fw-bold mt-3">Créer mon compte</button>
          </form>
          <hr>
          <div class="text-center"><span class="text-muted small">Déjà un compte ?</span> <a href="<?php echo e(route('login')); ?>" class="text-danger fw-semibold">Se connecter</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/frontend/auth/register.blade.php ENDPATH**/ ?>