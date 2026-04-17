<?php $__env->startSection('title', 'Accueil'); ?>
<?php $__env->startSection('content'); ?>

<!-- HERO -->
<section class="bh-hero">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2">
                    <i class="fa fa-star me-1"></i> Banque de l'Habitat — Tunisie
                </span>
                <h1 class="display-4 fw-bold mb-3">
                    Votre avenir financier<br>
                    <span style="color:var(--bh-gold2)">commence ici</span>
                </h1>
                <p class="lead text-white-75 mb-4">
                    BH Bank vous accompagne dans tous vos projets : crédits immobiliers,
                    épargne, solutions professionnelles et bien plus encore.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-bh-gold btn-lg px-4 fw-semibold">
                        <i class="fa fa-user-plus me-2"></i>Ouvrir un compte
                    </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('visitor.offres')); ?>" class="btn btn-outline-light btn-lg px-4">
                        <i class="fa fa-tags me-2"></i>Découvrir nos offres
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                <div class="p-4 rounded-3" style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15)">
                    <div class="text-center text-white">
                        <i class="fa fa-university" style="font-size:80px;color:var(--bh-gold2);opacity:.8"></i>
                        <div class="mt-3 fw-bold fs-5">BH Bank</div>
                        <div class="text-white-50 small">Banque de l'Habitat</div>
                        <div class="mt-3 d-flex gap-3 justify-content-center">
                            <div class="text-center">
                                <div class="fw-bold fs-4" style="color:var(--bh-gold2)">35+</div>
                                <div class="small text-white-50">Agences</div>
                            </div>
                            <div class="text-center">
                                <div class="fw-bold fs-4" style="color:var(--bh-gold2)">1989</div>
                                <div class="small text-white-50">Fondée</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="py-4 bg-white border-bottom">
    <div class="container">
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="fw-bold fs-2" style="color:var(--bh-navy)">35+</div>
                <div class="text-muted small">Agences en Tunisie</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="fw-bold fs-2" style="color:var(--bh-navy)">500K+</div>
                <div class="text-muted small">Clients satisfaits</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="fw-bold fs-2" style="color:var(--bh-navy)">7.5%</div>
                <div class="text-muted small">Taux crédit immobilier</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="fw-bold fs-2" style="color:var(--bh-navy)">35ans</div>
                <div class="text-muted small">D'expérience</div>
            </div>
        </div>
    </div>
</section>

<!-- OFFRES -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Nos offres phares</h2>
            <p class="text-muted">Des solutions bancaires adaptées à chaque besoin</p>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $offres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="offre-card card h-100">
                    <div class="card-header py-3">
                        <div class="d-flex align-items-center gap-2">
                            <?php if($offre->categorie): ?>
                            <i class="fa <?php echo e($offre->categorie->icone ?? 'fa-tag'); ?> fs-5"></i>
                            <?php endif; ?>
                            <div>
                                <div class="fw-bold"><?php echo e($offre->titre); ?></div>
                                <?php if($offre->categorie): ?>
                                <div class="small opacity-75"><?php echo e($offre->categorie->nom); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small"><?php echo e(Str::limit($offre->description, 120)); ?></p>
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            <?php if($offre->taux_interet): ?>
                            <span class="badge bg-success-subtle text-success">
                                <i class="fa fa-percent me-1"></i><?php echo e($offre->taux_interet); ?>% taux
                            </span>
                            <?php endif; ?>
                            <?php if($offre->duree_mois): ?>
                            <span class="badge bg-info-subtle text-info">
                                <i class="fa fa-clock me-1"></i><?php echo e($offre->duree_mois); ?> mois
                            </span>
                            <?php endif; ?>
                            <?php if($offre->montant_min): ?>
                            <span class="badge bg-warning-subtle text-warning">
                                Dès <?php echo e(number_format($offre->montant_min, 0, ',', ' ')); ?> DT
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('client.reservations.create')); ?>" class="btn btn-bh-primary btn-sm w-100">
                            <i class="fa fa-calendar-plus me-1"></i>Prendre un RDV
                        </a>
                        <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-bh-primary btn-sm w-100">
                            <i class="fa fa-info-circle me-1"></i>En savoir plus
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo e(route('visitor.offres')); ?>" class="btn btn-outline-primary px-4">
                Voir toutes les offres <i class="fa fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- MAP AGENCES (Leaflet) -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Nos agences près de vous</h2>
            <p class="text-muted">Retrouvez toutes nos agences BH Bank en Tunisie</p>
        </div>
        <div id="map-home" style="height:400px;border-radius:14px;box-shadow:0 4px 20px rgba(0,0,0,.1)"></div>
        <div class="text-center mt-3">
            <a href="<?php echo e(route('visitor.agences')); ?>" class="btn btn-bh-primary px-4">
                <i class="fa fa-map me-2"></i>Voir toutes les agences
            </a>
        </div>
    </div>
</section>

<!-- AVIS -->
<?php if($avis->count()): ?>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Ce que disent nos clients</h2>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $avis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $av): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-3">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bh-avatar-sm"><?php echo e(strtoupper(substr($av->client->prenom,0,1))); ?></div>
                        <div>
                            <div class="fw-semibold"><?php echo e($av->client->prenom); ?> <?php echo e(substr($av->client->nom,0,1)); ?>.</div>
                            <div class="bh-stars small">
                                <?php for($i=1;$i<=5;$i++): ?>
                                <i class="fa fa-star<?php echo e($i <= $av->note ? '' : '-o'); ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted small fst-italic mb-0">"<?php echo e(Str::limit($av->commentaire, 120)); ?>"</p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CHATBOT CTA -->
<section class="py-5" style="background:linear-gradient(135deg,var(--bh-navy),var(--bh-navy2))">
    <div class="container text-center text-white">
        <i class="fa fa-robot fs-1 mb-3" style="color:var(--bh-gold2)"></i>
        <h3 class="fw-bold mb-2">Besoin d'informations ?</h3>
        <p class="text-white-50 mb-4">Notre assistant virtuel est disponible 24h/24 pour répondre à vos questions.</p>
        <a href="<?php echo e(route('visitor.chatbot')); ?>" class="btn btn-bh-gold btn-lg px-5">
            <i class="fa fa-comments me-2"></i>Contacter le chatbot
        </a>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
var agences = <?php echo json_encode($agences, 15, 512) ?>;
var mapHome = L.map('map-home').setView([34.0, 9.5], 6);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(mapHome);

var bhIcon = L.divIcon({
    html: '<div style="background:var(--bh-navy);color:white;width:32px;height:32px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);display:flex;align-items:center;justify-content:center;border:2px solid var(--bh-gold)"><span style="transform:rotate(45deg);font-size:13px;font-weight:700">BH</span></div>',
    iconSize: [32, 32], iconAnchor: [16, 32], popupAnchor: [0, -34],
    className: ''
});

agences.forEach(function(a) {
    if (a.latitude && a.longitude) {
        L.marker([a.latitude, a.longitude], {icon: bhIcon})
            .addTo(mapHome)
            .bindPopup('<div class="bh-popup"><h6>' + a.nom + '</h6><p><i class="fa fa-map-marker-alt me-1"></i>' + a.adresse + ', ' + a.ville + '</p></div>');
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/visitor/home.blade.php ENDPATH**/ ?>