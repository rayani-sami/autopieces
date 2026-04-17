<?php $__env->startSection('title','Nouvelle Agence'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.agences.index')); ?>">Agences</a></li>
    <li class="breadcrumb-item active">Créer</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card bh-card p-4">
            <h5 class="fw-bold mb-4"><i class="fa fa-building me-2 text-primary"></i>Nouvelle agence</h5>
            <form method="POST" action="<?php echo e(route('admin.agences.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Nom de l'agence *</label>
                        <input type="text" name="nom" class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nom')); ?>" required placeholder="Ex: BH Bank - Tunis Centre">
                        <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Adresse *</label>
                        <input type="text" name="adresse" class="form-control" value="<?php echo e(old('adresse')); ?>" required placeholder="Rue, Numéro...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Ville *</label>
                        <input type="text" name="ville" class="form-control" value="<?php echo e(old('ville')); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="<?php echo e(old('telephone')); ?>" placeholder="+216 XX XXX XXX">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Heure ouverture *</label>
                        <input type="time" name="heure_ouverture" class="form-control" value="<?php echo e(old('heure_ouverture','08:00')); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Heure fermeture *</label>
                        <input type="time" name="heure_fermeture" class="form-control" value="<?php echo e(old('heure_fermeture','16:30')); ?>" required>
                    </div>

                    <!-- Leaflet Map Picker -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-map-marker-alt me-1 text-danger"></i>
                            Localisation sur la carte
                            <span class="text-muted fw-normal small">(cliquez sur la carte pour placer le marqueur)</span>
                        </label>
                        <div id="map-create" class="mb-2"></div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label small">Latitude</label>
                                <input type="number" step="any" name="latitude" id="lat_input" class="form-control" value="<?php echo e(old('latitude')); ?>" placeholder="Ex: 36.8190">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Longitude</label>
                                <input type="number" step="any" name="longitude" id="lng_input" class="form-control" value="<?php echo e(old('longitude')); ?>" placeholder="Ex: 10.1658">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="est_active" id="est_active" value="1" checked>
                            <label class="form-check-label fw-semibold" for="est_active">Agence active</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-bh-primary px-4"><i class="fa fa-save me-1"></i>Créer l'agence</button>
                    <a href="<?php echo e(route('admin.agences.index')); ?>" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
var map = L.map('map-create').setView([34.0, 9.5], 6);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

var marker = null;
var latInput = document.getElementById('lat_input');
var lngInput = document.getElementById('lng_input');

map.on('click', function(e) {
    var lat = e.latlng.lat.toFixed(7);
    var lng = e.latlng.lng.toFixed(7);
    latInput.value = lat;
    lngInput.value = lng;
    if (marker) marker.setLatLng(e.latlng);
    else marker = L.marker(e.latlng).addTo(map).bindPopup('Agence ici').openPopup();
});

// Sync inputs -> map
[latInput, lngInput].forEach(function(input) {
    input.addEventListener('change', function() {
        var lat = parseFloat(latInput.value);
        var lng = parseFloat(lngInput.value);
        if (!isNaN(lat) && !isNaN(lng)) {
            if (marker) marker.setLatLng([lat, lng]);
            else marker = L.marker([lat, lng]).addTo(map);
            map.setView([lat, lng], 13);
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/admin/agences/create.blade.php ENDPATH**/ ?>