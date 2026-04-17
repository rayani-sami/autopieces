<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Facture {{ $order->order_number }}</title>
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
    <div><strong>{{ $order->order_number }}</strong></div>
    <div>Date: {{ $order->created_at->format('d/m/Y') }}</div>
    <div><span class="badge">{{ \App\Models\Order::STATUSES[$order->status]['label'] ?? $order->status }}</span></div>
  </div>
</div>

<div style="display:flex;justify-content:space-between;margin-bottom:20px">
  <div>
    <strong>Facturé à:</strong><br>
    {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
    {{ $order->shipping_address }}<br>
    {{ $order->shipping_city }}{{ $order->shipping_state ? ', '.$order->shipping_state : '' }}, Tunisie<br>
    Tél: {{ $order->shipping_phone }}
  </div>
</div>

<table>
  <thead><tr><th>Produit</th><th>Référence</th><th>Qté</th><th>Prix unit. TND</th><th>Total TND</th></tr></thead>
  <tbody>
    @foreach($order->items as $item)
    <tr><td>{{ $item->product_name }}</td><td>{{ $item->product_reference }}</td><td class="text-right">{{ $item->quantity }}</td><td class="text-right">{{ number_format($item->unit_price,3) }}</td><td class="text-right">{{ number_format($item->total_price,3) }}</td></tr>
    @endforeach
    <tr><td colspan="4" class="text-right">Sous-total</td><td class="text-right">{{ number_format($order->subtotal,3) }}</td></tr>
    @if($order->discount > 0)<tr><td colspan="4" class="text-right">Réduction</td><td class="text-right">-{{ number_format($order->discount,3) }}</td></tr>@endif
    <tr><td colspan="4" class="text-right">Livraison</td><td class="text-right">{{ number_format($order->shipping_cost,3) }}</td></tr>
    <tr class="total-row"><td colspan="4" class="text-right">TOTAL TND</td><td class="text-right">{{ number_format($order->total,3) }}</td></tr>
  </tbody>
</table>

<div style="margin-top:30px;border-top:1px solid #dee2e6;padding-top:15px;font-size:11px;color:#666">
  <p>Mode de paiement: {{ $order->payment_method === 'cash_on_delivery' ? 'Paiement à la livraison' : 'Virement bancaire' }}</p>
  @if($order->notes)<p>Notes: {{ $order->notes }}</p>@endif
  <p>Merci pour votre confiance !</p>
</div>
</body>
</html>
