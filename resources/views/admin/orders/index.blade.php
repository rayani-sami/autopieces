@extends('layouts.admin')
@section('page-title','Commandes')
@section('content')
<div class="card border-0 shadow-sm mb-3">
  <div class="card-body">
    <form method="GET" class="row g-2 align-items-end">
      <div class="col-md-3"><input type="text" name="search" class="form-control form-control-sm" placeholder="N° commande ou email..." value="{{ request('search') }}"></div>
      <div class="col-md-2">
        <select name="status" class="form-select form-select-sm">
          <option value="">Tous les statuts</option>
          @foreach(\App\Models\Order::STATUSES as $k=>$v)<option value="{{ $k }}" {{ request('status')===$k?'selected':'' }}>{{ $v['label'] }}</option>@endforeach
        </select>
      </div>
      <div class="col-md-2"><input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}"></div>
      <div class="col-md-2"><input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}"></div>
      <div class="col-md-2"><button type="submit" class="btn btn-danger btn-sm w-100">Filtrer</button></div>
      <div class="col-md-1"><a href="{{ route('admin.commandes.index') }}" class="btn btn-outline-secondary btn-sm w-100">Reset</a></div>
    </form>
  </div>
</div>
<!-- Status tabs -->
<div class="d-flex gap-2 mb-3 flex-wrap">
  <a href="{{ route('admin.commandes.index') }}" class="btn btn-{{ !request('status')?'danger':'outline-secondary' }} btn-sm">Tout ({{ $statusCounts->sum() }})</a>
  @foreach(\App\Models\Order::STATUSES as $k=>$v)<a href="{{ route('admin.commandes.index',['status'=>$k]) }}" class="btn btn-{{ request('status')===$k?'danger':'outline-secondary' }} btn-sm">{{ $v['label'] }} ({{ $statusCounts[$k]??0 }})</a>@endforeach
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>N° Commande</th><th>Client</th><th>Ville</th><th>Date</th><th>Total</th><th>Paiement</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td><a href="{{ route('admin.commandes.show',$order) }}" class="fw-semibold text-danger">{{ $order->order_number }}</a></td>
          <td><div class="fw-semibold">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</div><div class="text-muted small">{{ $order->shipping_phone }}</div></td>
          <td>{{ $order->shipping_city }}</td>
          <td>{{ $order->created_at->format('d/m/Y') }}</td>
          <td class="fw-bold">{{ number_format($order->total,3) }}</td>
          <td><span class="badge bg-{{ $order->payment_method==='bank_transfer'?'info':'secondary' }} small">{{ $order->payment_method==='cash_on_delivery'?'À la livraison':'Virement' }}</span></td>
          <td><span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
          <td><a href="{{ route('admin.commandes.show',$order) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a><a href="{{ route('admin.commandes.invoice',$order) }}" class="btn btn-outline-primary btn-sm ms-1"><i class="fas fa-file-pdf"></i></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3">{{ $orders->withQueryString()->links() }}</div>
@endsection
