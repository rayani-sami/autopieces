<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Facture <?php echo e($order->order_number); ?></title>
<style>
body{font-family:Arial,sans-serif;font-size:12px;color:#333;margin:0;padding:20px}
.header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:30px;border-bottom:2px solid #e74c3c;padding-bottom:15px}
.logo{font-size:24px;font-weight:bold}.logo span{color:#e74c3c}
h1{font-size:18px;color:#333;margin:0 0 5px}
table{width:100%;border-collapse:collapse;margin:15px 0}
th{background:#f8f9fa;border:1px solid #dee2e6;padding:8px;text-align:left;font-size:11px}
td{border:1px solid #dee2e6;padding:8px;font-size:11px}
.total-row{font-weight:bold;background:#f8f9fa}
.badge{background:#e74c3c;color:white;padding:3px 8px;border-radius:3px;font-size:10px}
.text-right{text-align:right}
</style>
</head>
<body>
<div class="header">
  <div>
    <div class="logo"><span>Auto</span>Part.tn</div>
    <div>Route Zarzis, Ben Gardene, Tunisie</div>
    <div>Tél: +216 28 878 286</div>
    <div>autopart.tunisia@gmail.com</div>
  </div>
  <div class="text-right">
    <h1>FACTURE</h1>
    <div><strong><?php echo e($order->order_number); ?></strong></div>
    <div>Date: <?php echo e($order->created_at->format('d/m/Y')); ?></div>
    <div><span class="badge"><?php echo e(\App\Models\Order::STATUSES[$order->status]['label'] ?? $order->status); ?></span></div>
  </div>
</div>

<div style="display:flex;justify-content:space-between;margin-bottom:20px">
  <div>
    <strong>Facturé à:</strong><br>
    <?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?><br>
    <?php echo e($order->shipping_address); ?><br>
    <?php echo e($order->shipping_city); ?><?php echo e($order->shipping_state ? ', '.$order->shipping_state : ''); ?>, Tunisie<br>
    Tél: <?php echo e($order->shipping_phone); ?>

  </div>
</div>

<table>
  <thead><tr><th>Produit</th><th>Référence</th><th>Qté</th><th>Prix unit. TND</th><th>Total TND</th></tr></thead>
  <tbody>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr><td><?php echo e($item->product_name); ?></td><td><?php echo e($item->product_reference); ?></td><td class="text-right"><?php echo e($item->quantity); ?></td><td class="text-right"><?php echo e(number_format($item->unit_price,3)); ?></td><td class="text-right"><?php echo e(number_format($item->total_price,3)); ?></td></tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <tr><td colspan="4" class="text-right">Sous-total</td><td class="text-right"><?php echo e(number_format($order->subtotal,3)); ?></td></tr>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->discount > 0): ?><tr><td colspan="4" class="text-right">Réduction</td><td class="text-right">-<?php echo e(number_format($order->discount,3)); ?></td></tr><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <tr><td colspan="4" class="text-right">Livraison</td><td class="text-right"><?php echo e(number_format($order->shipping_cost,3)); ?></td></tr>
    <tr class="total-row"><td colspan="4" class="text-right">TOTAL TND</td><td class="text-right"><?php echo e(number_format($order->total,3)); ?></td></tr>
  </tbody>
</table>

<div style="margin-top:30px;border-top:1px solid #dee2e6;padding-top:15px;font-size:11px;color:#666">
  <p>Mode de paiement: <?php echo e($order->payment_method === 'cash_on_delivery' ? 'Paiement à la livraison' : 'Virement bancaire'); ?></p>
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->notes): ?><p>Notes: <?php echo e($order->notes); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  <p>Merci pour votre confiance !</p>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/admin/orders/invoice.blade.php ENDPATH**/ ?>