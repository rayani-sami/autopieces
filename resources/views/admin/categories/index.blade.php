@extends('layouts.admin')
@section('page-title','Catégories')
@section('content')
<div class="d-flex justify-content-between mb-3">
  <a href="{{ route('admin.categories.create') }}" class="btn btn-danger"><i class="fas fa-plus me-1"></i>Nouvelle catégorie</a>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light"><tr><th>Image</th><th>Nom</th><th>Parent</th><th>Produits</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($categories as $cat)
        <tr>
          <td>@if($cat->image)<img src="{{ Storage::url($cat->image) }}" style="height:35px;width:35px;object-fit:contain;background:#f8f9fa" class="rounded">@else<i class="fas fa-folder text-muted"></i>@endif</td>
          <td><span class="{{ !$cat->parent_id ? 'fw-bold' : 'ms-3 text-muted' }}">{{ !$cat->parent_id ? '' : '↳ ' }}{{ $cat->name }}</span></td>
          <td class="small text-muted">{{ $cat->parent?->name }}</td>
          <td><span class="badge bg-light text-dark border">{{ $cat->products->count() }}</span></td>
          <td><span class="badge bg-{{ $cat->is_active?'success':'secondary' }}">{{ $cat->is_active?'Actif':'Inactif' }}</span></td>
          <td>
            <a href="{{ route('admin.categories.edit',$cat) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.categories.destroy',$cat) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-outline-danger btn-sm ms-1" onclick="return confirm('Supprimer ?')"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
