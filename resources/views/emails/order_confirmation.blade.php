<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Confirmation commande {{ $order->order_number }}</title>
<style>body{font-family:Arial,sans-serif;background:#f4f4f4;margin:0;padding:20px}.container{max-width:600px;margin:0 auto;background:white;border-radius:8px;overflow:hidden}.header{background:#e74c3c;color:white;padding:30px;text-align:center}.content{padding:30px}.footer{background:#f8f9fa;padding:20px;text-align:center;color:#666;font-size:12px}table{width:100%;border-collapse:collapse}th,td{padding:10px;text-align:left;border-bottom:1px solid #eee}th{background:#f8f9fa}.total{font-size:18px;font-weight:bold;color:#e74c3c}</style>
</head>
<body>
<div class="container">
  <div class="header"><h1>Commande confirmée !</h1><p>{{ $order->order_number }}</p></div>
  <div class="content">
    <p>Bonjour {{ $order->shipping_first_name }},</p>
    <p>Merci pour votre commande. Nous vous confirmons sa bonne réception.</p>
    <table><thead><tr><th>Produit</th><th>Qté</th><th>Prix</th></tr></thead>
    <tbody>
      @foreach($order->items as $item)
      <tr><td>{{ $item->product_name }}</td><td>{{ $item->quantity }}</td><td>{{ number_format($item->total_price,3) }} TND</td></tr>
      @endforeach
      <tr><td colspan="2"><strong>Total</strong></td><td class="total">{{ number_format($order->total,3) }} TND</td></tr>
    </tbody></table>
    <p style="margin-top:20px"><strong>Livraison à:</strong><br>{{ $order->shipping_address }}, {{ $order->shipping_city }}</p>
    <p>En cas de question, contactez-nous au <strong>+216 23 136 136</strong> ou sur WhatsApp.</p>
  </div>
  <div class="footer">AutoPart.tn - Route ceinture Megrine Jawhra, Ben Arous, Tunisie</div>
</div>
</body>
</html>
