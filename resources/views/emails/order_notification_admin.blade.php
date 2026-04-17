<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Nouvelle commande</title>
<style>body{font-family:Arial,sans-serif;background:#f4f4f4;margin:0;padding:20px}.container{max-width:600px;margin:0 auto;background:white;border-radius:8px;overflow:hidden}.header{background:#1a1a2e;color:white;padding:20px;text-align:center}.content{padding:25px}.table{width:100%;border-collapse:collapse;margin:15px 0}.table th,.table td{padding:8px;border:1px solid #eee;font-size:13px}.table th{background:#f8f9fa}</style>
</head>
<body>
<div class="container">
  <div class="header"><h2>Nouvelle commande reçue</h2><p style="opacity:.8">{{ $order->order_number }}</p></div>
  <div class="content">
    <p><strong>Client:</strong> {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
    <p><strong>Téléphone:</strong> {{ $order->shipping_phone }}</p>
    <p><strong>Adresse:</strong> {{ $order->shipping_address }}, {{ $order->shipping_city }}</p>
    <p><strong>Paiement:</strong> {{ $order->payment_method === 'cash_on_delivery' ? 'À la livraison' : 'Virement' }}</p>
    <table class="table">
      <thead><tr><th>Produit</th><th>Qté</th><th>Prix</th></tr></thead>
      <tbody>
        @foreach($order->items as $item)
        <tr><td>{{ $item->product_name }}</td><td>{{ $item->quantity }}</td><td>{{ number_format($item->total_price, 3) }} TND</td></tr>
        @endforeach
        <tr><td colspan="2"><strong>TOTAL</strong></td><td><strong>{{ number_format($order->total, 3) }} TND</strong></td></tr>
      </tbody>
    </table>
    @if($order->notes)<p><strong>Notes:</strong> {{ $order->notes }}</p>@endif
  </div>
</div>
</body>
</html>
