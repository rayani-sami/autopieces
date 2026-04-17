@extends('layouts.admin')
@section('page-title','Marques automobiles')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <a href="{{ route('admin.marques.create') }}" class="btn btn-danger"><i class="fas fa-plus me-1"></i>Nouvelle marque</a>
  <span class="text-muted small">{{ $makes->count() }} marques</span>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="table-light">
        <tr><th>Logo</th><th>Marque</th><th>Modèles</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($makes as $make)
        <tr>
          <td>
            @if($make->logo)
              <img src="{{ Storage::url($make->logo) }}" style="height:30px;width:50px;object-fit:contain" alt="{{ $make->name }}">
            @else
              <i class="fas fa-car text-muted"></i>
            @endif
          </td>
          <td class="fw-semibold">{{ $make->name }}</td>
          <td>
            <a href="{{ route('admin.marques.modeles.index', $make) }}" class="badge bg-info text-decoration-none">
              {{ $make->models_count }} modèles
            </a>
          </td>
          <td class="text-muted small">{{ $make->sort_order }}</td>
          <td><span class="badge bg-{{ $make->is_active ? 'success' : 'secondary' }}">{{ $make->is_active ? 'Actif' : 'Inactif' }}</span></td>
          <td>
            <a href="{{ route('admin.marques.modeles.index', $make) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-list me-1"></i>Modèles</a>
            <a href="{{ route('admin.marques.edit', $make) }}" class="btn btn-outline-secondary btn-sm ms-1"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.marques.destroy', $make) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger btn-sm ms-1" onclick="return confirm('Supprimer ?')">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted py-4">Aucune marque. <a href="{{ route('admin.marques.create') }}">Ajouter</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
