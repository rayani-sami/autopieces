@extends('layouts.admin')
@section('page-title','Utilisateurs')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <form method="GET" class="d-flex gap-2">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Nom, email, téléphone..." value="{{ request('search') }}" style="width:250px">
    <select name="role" class="form-select form-select-sm" style="width:130px">
      <option value="">Tous rôles</option>
      <option value="admin" {{ request('role')==='admin'?'selected':'' }}>Admin</option>
      <option value="manager" {{ request('role')==='manager'?'selected':'' }}>Manager</option>
      <option value="client" {{ request('role')==='client'?'selected':'' }}>Client</option>
    </select>
    <button type="submit" class="btn btn-outline-secondary btn-sm">Filtrer</button>
    <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
  </form>
  <span class="text-muted small">{{ $users->total() }} utilisateurs</span>
</div>
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="table-light">
        <tr><th>Nom</th><th>Email</th><th>Téléphone</th><th>Rôle</th><th>Commandes</th><th>Statut</th><th>Inscrit le</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td class="fw-semibold">{{ $user->full_name }}</td>
          <td class="small">{{ $user->email }}</td>
          <td class="small">{{ $user->phone ?: '-' }}</td>
          <td>
            @foreach($user->roles as $role)
              <span class="badge bg-{{ $role->name === 'admin' ? 'danger' : ($role->name === 'manager' ? 'warning' : 'secondary') }}">{{ $role->name }}</span>
            @endforeach
          </td>
          <td><span class="badge bg-light text-dark border">{{ $user->orders_count }}</span></td>
          <td><span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">{{ $user->is_active ? 'Actif' : 'Inactif' }}</span></td>
          <td class="small text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
          <td>
            <a href="{{ route('admin.utilisateurs.show', $user) }}" class="btn btn-outline-info btn-sm" title="Voir"><i class="fas fa-eye"></i></a>
            <a href="{{ route('admin.utilisateurs.edit', $user) }}" class="btn btn-outline-secondary btn-sm ms-1"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.utilisateurs.toggle', $user) }}" method="POST" class="d-inline">
              @csrf @method('PATCH')
              <button type="submit" class="btn btn-outline-{{ $user->is_active ? 'warning' : 'success' }} btn-sm ms-1" title="{{ $user->is_active ? 'Désactiver' : 'Activer' }}">
                <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted py-4">Aucun utilisateur trouvé.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3">{{ $users->withQueryString()->links() }}</div>
@endsection
