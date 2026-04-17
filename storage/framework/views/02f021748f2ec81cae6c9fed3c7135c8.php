<?php $__env->startSection('title','Nouveau Rendez-vous'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('client.reservations.index')); ?>">Mes réservations</a></li>
    <li class="breadcrumb-item active">Nouveau</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card bh-card p-4">
            <h5 class="fw-bold mb-4"><i class="fa fa-calendar-plus me-2 text-primary"></i>Prendre un rendez-vous</h5>
            <form method="POST" action="<?php echo e(route('client.reservations.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Agence *</label>
                        <select name="agence_id" class="form-select <?php $__errorArgs = ['agence_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required id="agenceSelect">
                            <option value="">— Choisir une agence —</option>
                            <?php $__currentLoopData = $agences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($agence->id); ?>"
                                data-lat="<?php echo e($agence->latitude); ?>"
                                data-lng="<?php echo e($agence->longitude); ?>"
                                data-nom="<?php echo e($agence->nom); ?>"
                                data-adresse="<?php echo e($agence->adresse); ?>, <?php echo e($agence->ville); ?>"
                                data-tel="<?php echo e($agence->telephone); ?>"
                                data-ouv="<?php echo e(substr($agence->heure_ouverture,0,5)); ?>"
                                data-fer="<?php echo e(substr($agence->heure_fermeture,0,5)); ?>"
                                <?php echo e(old('agence_id') == $agence->id ? 'selected' : ''); ?>>
                                <?php echo e($agence->nom); ?> — <?php echo e($agence->ville); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['agence_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Mini Leaflet map -->
                    <div class="col-12">
                        <div id="map-rdv" style="height:240px;border-radius:10px;display:none"></div>
                        <div id="agence-info" class="alert alert-info py-2 mt-2" style="display:none;font-size:13px"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Date du rendez-vous *</label>
                        <input type="date" name="date_rdv" class="form-control <?php $__errorArgs = ['date_rdv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('date_rdv')); ?>" min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>" required>
                        <?php $__errorArgs = ['date_rdv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Heure *</label>
                        <select name="heure_rdv" class="form-select <?php $__errorArgs = ['heure_rdv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">— Choisir —</option>
                            <?php $__currentLoopData = ['08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($h); ?>:00" <?php echo e(old('heure_rdv') == "$h:00" ? 'selected':''); ?>><?php echo e($h); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['heure_rdv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Motif du rendez-vous *</label>
                        <input type="text" name="motif" class="form-control <?php $__errorArgs = ['motif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('motif')); ?>" placeholder="Ex: Demande de crédit immobilier" required>
                        <?php $__errorArgs = ['motif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description (optionnel)</label>
                        <textarea name="description" class="form-control" rows="3"
                            placeholder="Précisez votre demande..."><?php echo e(old('description')); ?></textarea>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-bh-primary px-4">
                        <i class="fa fa-paper-plane me-1"></i>Envoyer la demande
                    </button>
                    <a href="<?php echo e(route('client.reservations.index')); ?>" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
var mapRdv = null;
var markerRdv = null;

document.getElementById('agenceSelect').addEventListener('change', function() {
    var opt = this.options[this.selectedIndex];
    var lat = parseFloat(opt.dataset.lat);
    var lng = parseFloat(opt.dataset.lng);
    var mapDiv = document.getElementById('map-rdv');
    var infoDiv = document.getElementById('agence-info');

    if (!this.value) { mapDiv.style.display='none'; infoDiv.style.display='none'; return; }

    infoDiv.style.display = 'block';
    infoDiv.innerHTML = '<i class="fa fa-building me-1"></i><strong>' + opt.dataset.nom + '</strong> — '
        + opt.dataset.adresse + ' | <i class="fa fa-clock me-1"></i>' + opt.dataset.ouv + '–' + opt.dataset.fer;

    if (lat && lng) {
        mapDiv.style.display = 'block';
        if (!mapRdv) {
            mapRdv = L.map('map-rdv').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution:'© OpenStreetMap'}).addTo(mapRdv);
            markerRdv = L.marker([lat, lng]).addTo(mapRdv)
                .bindPopup('<strong>' + opt.dataset.nom + '</strong><br>' + opt.dataset.adresse).openPopup();
        } else {
            mapRdv.setView([lat, lng], 15);
            markerRdv.setLatLng([lat, lng])
                .bindPopup('<strong>' + opt.dataset.nom + '</strong><br>' + opt.dataset.adresse).openPopup();
        }
        setTimeout(function(){ mapRdv.invalidateSize(); }, 100);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/client/reservations/create.blade.php ENDPATH**/ ?>