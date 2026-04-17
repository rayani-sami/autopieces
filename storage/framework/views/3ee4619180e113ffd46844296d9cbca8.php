<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Confirmation commande <?php echo e($order->order_number); ?></title>
<style>body{font-family:Arial,sans-serif;background:#f4f4f4;margin:0;padding:20px}.container{max-width:600px;margin:0 auto;background:white;border-radius:8px;overflow:hidden}.header{background:#e74c3c;color:white;padding:30px;text-align:center}.content{padding:30px}.footer{background:#f8f9fa;padding:20px;text-align:center;color:#666;font-size:12px}table{width:100%;border-collapse:collapse}th,td{padding:10px;text-align:left;border-bottom:1px solid #eee}th{background:#f8f9fa}.total{font-size:18px;font-weight:bold;color:#e74c3c}</style>
</head>
<body>
<div class="container">
  <div class="header"><h1>Commande confirmée !</h1><p><?php echo e($order->order_number); ?></p></div>
  <div class="content">
    <p>Bonjour <?php echo e($order->shipping_first_name); ?>,</p>
    <p>Merci pour votre commande. Nous vous confirmons sa bonne réception.</p>
    <table><thead><tr><th>Produit</th><th>Qté</th><th>Prix</th></tr></thead>
    <tbody>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr><td><?php echo e($item->product_name); ?></td><td><?php echo e($item->quantity); ?></td><td><?php echo e(number_format($item->total_price,3)); ?> TND</td></tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <tr><td colspan="2"><strong>Total</strong></td><td class="total"><?php echo e(number_format($order->total,3)); ?> TND</td></tr>
    </tbody></table>
    <p style="margin-top:20px"><strong>Livraison à:</strong><br><?php echo e($order->shipping_address); ?>, <?php echo e($order->shipping_city); ?></p>
    <p>En cas de question, contactez-nous au <strong>+216 23 136 136</strong> ou sur WhatsApp.</p>
  </div>
  <div class="footer">AutoPart.tn - Route ceinture Megrine Jawhra, Ben Arous, Tunisie</div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\autopart2\autopart_full\resources\views/emails/order_confirmation.blade.php ENDPATH**/ ?>