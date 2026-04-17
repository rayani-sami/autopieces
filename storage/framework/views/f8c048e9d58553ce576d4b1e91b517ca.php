<?php $__env->startSection('title', 'Nos Agences'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid py-4">
    <div class="container mb-4">
        <h2 class="fw-bold"><i class="fa fa-map-marker-alt me-2" style="color:var(--bh-gold)"></i>Nos Agences</h2>
        <p class="text-muted">Retrouvez toutes les agences BH Bank sur la carte interactive</p>
    </div>

    <div class="row g-0" style="max-height:80vh">
        <!-- Liste agences -->
        <div class="col-md-4 bg-white border-end" style="overflow-y:auto;max-height:80vh">
            <div class="p-3 border-bottom bg-light sticky-top">
                <input type="text" id="searchAgence" class="form-control form-control-sm" placeholder="🔍 Rechercher une agence ou ville...">
            </div>
            <div id="agenceList">
            <?php $__currentLoopData = $agences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="agence-item p-3 border-bottom" style="cursor:pointer" data-lat="<?php echo e($agence->latitude); ?>" data-lng="<?php echo e($agence->longitude); ?>" data-id="<?php echo e($agence->id); ?>" onclick="flyToAgence(<?php echo e($agence->latitude); ?>, <?php echo e($agence->longitude); ?>, <?php echo e($agence->id); ?>)">
                <div class="d-flex align-items-start gap-3">
                    <div class="bh-logo-circle mt-1" style="width:34px;height:34px;flex-shrink:0">
                        <span style="font-size:11px">BH</span>
                    </div>
                    <div>
                        <div class="fw-semibold"><?php echo e($agence->nom); ?></div>
                        <div class="text-muted small"><i class="fa fa-map-marker-alt me-1"></i><?php echo e($agence->adresse); ?>, <?php echo e($agence->ville); ?></div>
                        <?php if($agence->telephone): ?>
                        <div class="text-muted small"><i class="fa fa-phone me-1"></i><?php echo e($agence->telephone); ?></div>
                        <?php endif; ?>
                        <div class="text-muted small mt-1">
                            <i class="fa fa-clock me-1"></i>
                            <?php echo e(\Carbon\Carbon::parse($agence->heure_ouverture)->format('H:i')); ?> -
                            <?php echo e(\Carbon\Carbon::parse($agence->heure_fermeture)->format('H:i')); ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Map -->
        <div class="col-md-8">
            <div id="map" style="height:80vh;border-radius:0"></div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
var agencesData = <?php echo json_encode($agencesJson, 15, 512) ?>;
var markers = {};

var map = L.map('map').setView([34.0, 9.5], 6);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 18
}).addTo(map);

var bhIcon = L.divIcon({
    html: '<div style="background:#003366;color:white;width:34px;height:34px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);display:flex;align-items:center;justify-content:center;border:2px solid #C8962B;box-shadow:0 2px 8px rgba(0,0,0,.3)"><span style="transform:rotate(45deg);font-size:12px;font-weight:900">BH</span></div>',
    iconSize: [34, 34], iconAnchor: [17, 34], popupAnchor: [0, -36],
    className: ''
});

agencesData.forEach(function(a) {
    if (a.lat && a.lng) {
        var popup = '<div class="bh-popup" style="min-width:200px">'
            + '<h6><i class="fa fa-university me-1"></i>' + a.nom + '</h6>'
            + '<p><i class="fa fa-map-marker-alt me-1 text-danger"></i>' + a.adresse + '<br>' + a.ville + '</p>'
            + (a.telephone ? '<p><i class="fa fa-phone me-1 text-success"></i>' + a.telephone + '</p>' : '')
            + '<p><i class="fa fa-clock me-1 text-primary"></i>' + a.ouverture + ' – ' + a.fermeture + '</p>'
            + '</div>';
        markers[a.id] = L.marker([a.lat, a.lng], {icon: bhIcon}).addTo(map).bindPopup(popup);
    }
});

function flyToAgence(lat, lng, id) {
    if (!lat || !lng) return;
    map.flyTo([lat, lng], 15, {duration: 1.2});
    setTimeout(function() {
        if (markers[id]) markers[id].openPopup();
    }, 1300);
    // highlight list item
    document.querySelectorAll('.agence-item').forEach(el => el.style.background = '');
    document.querySelector('[data-id="' + id + '"]').style.background = '#f0f4f8';
}

// Search filter
document.getElementById('searchAgence').addEventListener('input', function() {
    var q = this.value.toLowerCase();
    document.querySelectorAll('.agence-item').forEach(function(el) {
        el.style.display = el.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/visitor/agences.blade.php ENDPATH**/ ?>