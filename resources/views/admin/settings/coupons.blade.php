@extends('layouts.admin')
@section('page-title','Coupons')
@section('content')
<div class="d-flex justify-content-between mb-3">
  <a href="{{ route('admin.coupons.create') }}" class="btn btn-danger"><i class="fas fa-plus me-1"></i>Nouveau coupon</a>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>Code</th><th>Type</th><th>Valeur</th><th>Min. commande</th><th>Utilisations</th><th>Expiration</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($coupons as $c)
        <tr>
          <td class="fw-bold fw-mono">{{ $c->code }}</td>
          <td><span class="badge bg-{{ $c->type==='percentage'?'info':'primary' }}">{{ $c->type==='percentage'?'Pourcentage':'Montant fixe' }}</span></td>
          <td>{{ $c->type==='percentage'?$c->value.'%':number_format($c->value,3).' TND' }}</td>
          <td class="small">{{ number_format($c->min_order,3) }} TND</td>
          <td>{{ $c->used_count }}{{ $c->usage_limit?' / '.$c->usage_limit:'' }}</td>
          <td class="small">{{ $c->expires_at?$c->expires_at->format('d/m/Y'):'Sans limite' }}</td>
          <td><span class="badge bg-{{ $c->isValid()?'success':'secondary' }}">{{ $c->isValid()?'Valide':'Invalide' }}</span></td>
          <td>
            <a href="{{ route('admin.coupons.edit',$c) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.coupons.destroy',$c) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-outline-danger btn-sm ms-1" onclick="return confirm('Supprimer ?')"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3">{{ $coupons->links() }}</div>
@endsection
