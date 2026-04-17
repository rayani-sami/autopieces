@extends('layouts.admin')
@section('page-title','Client: '.$user->full_name)
@section('content')
<div class="row g-4">
  <div class="col-md-4">
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-body text-center p-4">
        <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px;font-size:1.5rem">{{ strtoupper(substr($user->first_name,0,1)) }}</div>
        <h5 class="fw-bold">{{ $user->full_name }}</h5>
        <div class="text-muted small">{{ $user->email }}</div>
        <div class="text-muted small">{{ $user->phone }}</div>
        <div class="mt-2">
          @foreach($user->roles as $role)
            <span class="badge bg-{{ $role->name === 'admin' ? 'danger' : ($role->name === 'manager' ? 'warning' : 'secondary') }}">{{ $role->name }}</span>
          @endforeach
        </div>
      </div>
      <div class="card-footer bg-white text-center">
        <small class="text-muted">Membre depuis {{ $user->created_at->format('d/m/Y') }}</small>
      </div>
    </div>
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="fw-bold mb-3">Adresses</h6>
        @forelse($user->addresses as $addr)
          <div class="border-bottom pb-2 mb-2 small">
            <div class="fw-semibold">{{ $addr->label }}</div>
            <div class="text-muted">{{ $addr->address_line1 }}, {{ $addr->city }}</div>
          </div>
        @empty
          <p class="text-muted small">Aucune adresse.</p>
        @endforelse
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-header bg-white d-flex justify-content-between">
        <h6 class="fw-bold mb-0">Commandes ({{ $user->orders->count() }})</h6>
        <span class="text-muted small">Total: {{ number_format($user->orders->sum('total'), 3) }} TND</span>
      </div>
      <div class="table-responsive">
        <table class="table table-hover mb-0 small">
          <thead class="table-light"><tr><th>N°</th><th>Date</th><th>Total</th><th>Statut</th><th></th></tr></thead>
          <tbody>
            @forelse($user->orders as $order)
            <tr>
              <td class="fw-semibold">{{ $order->order_number }}</td>
              <td>{{ $order->created_at->format('d/m/Y') }}</td>
              <td>{{ number_format($order->total, 3) }} TND</td>
              <td><span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
              <td><a href="{{ route('admin.commandes.show', $order) }}" class="btn btn-outline-secondary btn-sm py-0"><i class="fas fa-eye"></i></a></td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-muted">Aucune commande.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
