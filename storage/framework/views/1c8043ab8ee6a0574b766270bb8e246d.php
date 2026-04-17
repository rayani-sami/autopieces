<?php $__env->startSection('title','Détail Réservation'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('client.reservations.index')); ?>">Mes réservations</a></li>
    <li class="breadcrumb-item active">Détail</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card bh-card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="fa fa-calendar-check me-2 text-primary"></i>Réservation #<?php echo e($reservation->id); ?></h6>
                <span class="badge bg-<?php echo e($reservation->statutClass()); ?> px-3 py-2 fs-6"><?php echo e($reservation->statutLabel()); ?></span>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8fafc">
                            <div class="text-muted small fw-bold mb-2">DATE & HEURE</div>
                            <div class="fs-5 fw-bold text-primary"><?php echo e($reservation->date_rdv->format('d/m/Y')); ?></div>
                            <div class="fw-semibold"><?php echo e(substr($reservation->heure_rdv,0,5)); ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8fafc">
                            <div class="text-muted small fw-bold mb-2">AGENCE</div>
                            <div class="fw-bold"><?php echo e($reservation->agence->nom); ?></div>
                            <div class="text-muted small"><?php echo e($reservation->agence->adresse); ?>, <?php echo e($reservation->agence->ville); ?></div>
                            <?php if($reservation->agence->telephone): ?>
                            <div class="text-muted small"><i class="fa fa-phone me-1"></i><?php echo e($reservation->agence->telephone); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($reservation->agence->latitude): ?>
                    <div class="col-12">
                        <div id="map-show" style="height:200px;border-radius:10px"></div>
                    </div>
                    <?php endif; ?>

                    <div class="col-12">
                        <div class="text-muted small fw-bold mb-1">MOTIF</div>
                        <p class="fw-semibold mb-0"><?php echo e($reservation->motif); ?></p>
                    </div>
                    <?php if($reservation->description): ?>
                    <div class="col-12">
                        <div class="text-muted small fw-bold mb-1">DESCRIPTION</div>
                        <p class="mb-0"><?php echo e($reservation->description); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if($reservation->agent): ?>
                    <div class="col-12">
                        <div class="text-muted small fw-bold mb-1">AGENT ASSIGNÉ</div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bh-avatar-sm" style="background:var(--bh-navy)"><?php echo e(strtoupper(substr($reservation->agent->prenom,0,1))); ?></div>
                            <span class="fw-semibold"><?php echo e($reservation->agent->nom_complet); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($reservation->note_agent): ?>
                    <div class="col-12">
                        <div class="alert alert-<?php echo e($reservation->statut === 'accepte' ? 'success' : 'warning'); ?> mb-0">
                            <div class="fw-bold small mb-1">Message de l'agent :</div>
                            <?php echo e($reservation->note_agent); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer bg-white d-flex gap-2">
                <a href="<?php echo e(route('client.reservations.index')); ?>" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i>Retour
                </a>
                <?php if($reservation->statut === 'en_attente'): ?>
                <a href="<?php echo e(route('client.reservations.edit', $reservation)); ?>" class="btn btn-outline-primary">
                    <i class="fa fa-edit me-1"></i>Modifier
                </a>
                <form action="<?php echo e(route('client.reservations.annuler', $reservation)); ?>" method="POST" class="ms-auto">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-outline-danger" data-confirm="Annuler ce rendez-vous ?">
                        <i class="fa fa-times me-1"></i>Annuler
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if($reservation->agence->latitude): ?>
<?php $__env->startPush('scripts'); ?>
<script>
var mapShow = L.map('map-show').setView([<?php echo e($reservation->agence->latitude); ?>, <?php echo e($reservation->agence->longitude); ?>], 15);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution:'© OpenStreetMap'}).addTo(mapShow);
L.marker([<?php echo e($reservation->agence->latitude); ?>, <?php echo e($reservation->agence->longitude); ?>])
    .addTo(mapShow)
    .bindPopup('<strong><?php echo e($reservation->agence->nom); ?></strong>').openPopup();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/client/reservations/show.blade.php ENDPATH**/ ?>