<?php $__env->startSection('title','Détail Rendez-vous'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('agent.reservations.index')); ?>">Rendez-vous</a></li>
    <li class="breadcrumb-item active">Détail</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-4 justify-content-center">
    <div class="col-lg-8">
        <div class="card bh-card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="fa fa-calendar-check me-2 text-primary"></i>Demande de Rendez-vous #<?php echo e($reservation->id); ?></h6>
                <span class="badge bg-<?php echo e($reservation->statutClass()); ?> px-3 py-2"><?php echo e($reservation->statutLabel()); ?></span>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="text-muted small fw-bold text-uppercase mb-3">Informations Client</h6>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bh-avatar"><?php echo e(strtoupper(substr($reservation->client->prenom,0,1))); ?></div>
                            <div>
                                <div class="fw-bold"><?php echo e($reservation->client->nom_complet); ?></div>
                                <div class="text-muted small"><?php echo e($reservation->client->email); ?></div>
                                <div class="text-muted small"><?php echo e($reservation->client->telephone); ?></div>
                                <div class="text-muted small">CIN : <?php echo e($reservation->client->cin); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted small fw-bold text-uppercase mb-3">Rendez-vous</h6>
                        <div class="mb-2 small"><i class="fa fa-calendar me-2 text-primary"></i><strong>Date :</strong> <?php echo e($reservation->date_rdv->format('d/m/Y')); ?></div>
                        <div class="mb-2 small"><i class="fa fa-clock me-2 text-primary"></i><strong>Heure :</strong> <?php echo e(substr($reservation->heure_rdv,0,5)); ?></div>
                        <div class="mb-2 small"><i class="fa fa-building me-2 text-primary"></i><strong>Agence :</strong> <?php echo e($reservation->agence->nom); ?></div>
                        <div class="mb-2 small"><i class="fa fa-map-marker-alt me-2 text-primary"></i><?php echo e($reservation->agence->adresse); ?>, <?php echo e($reservation->agence->ville); ?></div>
                    </div>
                    <div class="col-12">
                        <h6 class="text-muted small fw-bold text-uppercase mb-2">Motif</h6>
                        <p class="mb-1 fw-semibold"><?php echo e($reservation->motif); ?></p>
                        <?php if($reservation->description): ?>
                        <p class="text-muted small"><?php echo e($reservation->description); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($reservation->statut === 'en_attente'): ?>
                <hr>
                <h6 class="fw-bold mb-3">Traiter cette demande</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <form action="<?php echo e(route('agent.reservations.accepter', $reservation)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-2">
                                <label class="form-label small fw-semibold">Note pour le client</label>
                                <textarea name="note_agent" class="form-control form-control-sm" rows="2" placeholder="Message optionnel..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fa fa-check me-1"></i>Accepter le rendez-vous
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="<?php echo e(route('agent.reservations.refuser', $reservation)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-2">
                                <label class="form-label small fw-semibold">Raison du refus</label>
                                <textarea name="note_agent" class="form-control form-control-sm" rows="2" placeholder="Expliquez le motif du refus..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="fa fa-times me-1"></i>Refuser le rendez-vous
                            </button>
                        </form>
                    </div>
                </div>
                <?php elseif($reservation->note_agent): ?>
                <hr>
                <h6 class="fw-bold mb-2">Note de l'agent</h6>
                <div class="alert alert-<?php echo e($reservation->statut === 'accepte' ? 'success' : 'warning'); ?>">
                    <?php echo e($reservation->note_agent); ?>

                </div>
                <?php endif; ?>
            </div>
            <div class="card-footer bg-white">
                <a href="<?php echo e(route('agent.reservations.index')); ?>" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i>Retour
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/agent/reservations/show.blade.php ENDPATH**/ ?>