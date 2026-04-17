<?php $__env->startSection('title', 'Connexion'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <div class="bh-logo-circle mx-auto mb-3" style="width:60px;height:60px">
                    <span style="font-size:22px">BH</span>
                </div>
                <h4 class="fw-bold text-navy">Connexion</h4>
                <p class="text-muted">Accédez à votre espace BH Bank</p>
            </div>
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form method="POST" action="<?php echo e(route('login.post')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Adresse e-mail</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('email')); ?>" placeholder="votre@email.com" required autofocus>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock text-muted"></i></span>
                                <input type="password" name="password" id="pwd" class="form-control" placeholder="••••••••" required>
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePwd()"><i class="fa fa-eye" id="eyeIcon"></i></button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small" for="remember">Se souvenir de moi</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-bh-primary w-100 py-2 fw-semibold">
                            <i class="fa fa-sign-in-alt me-2"></i>Connexion
                        </button>
                    </form>
                    <hr class="my-4">
                    <p class="text-center text-muted small mb-0">
                        Pas encore de compte ?
                        <a href="<?php echo e(route('register')); ?>" class="fw-semibold text-decoration-none">Créer un compte</a>
                    </p>
                </div>
            </div>
            <!-- Demo credentials -->
            <div class="card border-0 bg-light mt-3">
                <div class="card-body py-2 px-3">
                    <p class="small mb-1 fw-bold text-muted">Comptes de démonstration :</p>
                    <div class="small text-muted">
                        <div><i class="fa fa-shield-alt text-danger me-1"></i><strong>Admin :</strong> admin@bh.com.tn / password</div>
                        <div><i class="fa fa-user-tie text-primary me-1"></i><strong>Agent :</strong> agent1@bh.com.tn / password</div>
                        <div><i class="fa fa-user text-success me-1"></i><strong>Client :</strong> client1@bh.com.tn / password</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function togglePwd() {
    var p = document.getElementById('pwd');
    var i = document.getElementById('eyeIcon');
    p.type = p.type === 'password' ? 'text' : 'password';
    i.className = p.type === 'password' ? 'fa fa-eye' : 'fa fa-eye-slash';
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/auth/login.blade.php ENDPATH**/ ?>