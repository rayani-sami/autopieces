@extends('layouts.admin')
@section('page-title','Modèles - '.$make->name)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
  <a href="{{ route('admin.marques.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i></a>
  <h5 class="mb-0 fw-bold">Modèles de {{ $make->name }}</h5>
</div>
<div class="row g-4">
  <div class="col-md-8">
    <div class="card border-0 shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
          <thead class="table-light"><tr><th>Nom</th><th>Années</th><th>Motorisations</th><th>Statut</th><th>Actions</th></tr></thead>
          <tbody>
            @forelse($models as $model)
            <tr>
              <td class="fw-semibold">{{ $model->name }}</td>
              <td class="text-muted small">{{ $model->year_from }}{{ $model->year_to ? ' - '.$model->year_to : '+' }}</td>
              <td><a href="{{ route('admin.modeles.motorisations.index', $model) }}" class="badge bg-info text-decoration-none">{{ $model->engines_count }} moteurs</a></td>
              <td><span class="badge bg-{{ $model->is_active ? 'success' : 'secondary' }}">{{ $model->is_active ? 'Actif' : 'Inactif' }}</span></td>
              <td>
                <a href="{{ route('admin.modeles.motorisations.index', $model) }}" class="btn btn-outline-info btn-sm" title="Motorisations"><i class="fas fa-cog"></i></a>
                <form action="{{ route('admin.modeles.destroy', $model) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm ms-1" onclick="return confirm('Supprimer ?')"><i class="fas fa-trash"></i></button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-muted py-3">Aucun modèle pour cette marque.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="fw-bold mb-3">Ajouter un modèle</h6>
        <form action="{{ route('admin.marques.modeles.store', $make) }}" method="POST">
          @csrf
          <div class="mb-2"><input type="text" name="name" class="form-control form-control-sm" placeholder="Nom du modèle *" required></div>
          <div class="row g-1 mb-2">
            <div class="col"><input type="number" name="year_from" class="form-control form-control-sm" placeholder="Année début" min="1980" max="2030"></div>
            <div class="col"><input type="number" name="year_to" class="form-control form-control-sm" placeholder="Année fin" min="1980" max="2030"></div>
          </div>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label small">Actif</label></div>
          <button type="submit" class="btn btn-danger btn-sm w-100">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
