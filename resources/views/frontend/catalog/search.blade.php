@extends('layouts.app')
@section('title', 'Recherche' . ($query ? ': '.e($query) : '') . ' - AutoPart')
@section('content')
<div class="container py-4">
  <!-- Search bar -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
      <form action="{{ route('search') }}" method="GET">
        <div class="input-group input-group-lg">
          <input type="text" name="q" class="form-control" placeholder="Nom de pièce, référence, marque..." value="{{ e($query) }}" autofocus>
          <button class="btn btn-danger px-4" type="submit"><i class="fas fa-search me-1"></i>Rechercher</button>
        </div>
      </form>
    </div>
  </div>

  @if($query)
  <div class="row g-4">
    <!-- Sidebar filters -->
    <div class="col-lg-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold mb-3"><i class="fas fa-filter text-danger me-2"></i>Affiner la recherche</h6>
          <form method="GET" action="{{ route('search') }}">
            <input type="hidden" name="q" value="{{ e($query) }}">

            @if($engine)
            <div class="alert alert-success-subtle p-2 mb-3 small border border-success-subtle">
              <i class="fas fa-car text-success me-1"></i>
              <strong>{{ $engine->carModel->make->name }} {{ $engine->carModel->name }}</strong>
            </div>
            @endif

            @if($categories->count())
            <div class="mb-3">
              <label class="fw-semibold small mb-2">Catégorie</label>
              @foreach($categories->take(8) as $cat)
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category_id" value="{{ $cat->id }}" id="cat{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'checked' : '' }}>
                <label class="form-check-label small" for="cat{{ $cat->id }}">{{ $cat->name }}</label>
              </div>
              @endforeach
            </div>
            @endif

            <div class="mb-3">
              <label class="fw-semibold small mb-2">Prix (TND)</label>
              <div class="row g-1">
                <div class="col-6"><input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}"></div>
                <div class="col-6"><input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}"></div>
              </div>
            </div>

            <div class="mb-3">
              <label class="fw-semibold small mb-2">Trier par</label>
              <select name="sort" class="form-select form-select-sm">
                <option value="relevance" {{ request('sort','relevance')==='relevance'?'selected':'' }}>Pertinence</option>
                <option value="price_asc" {{ request('sort')==='price_asc'?'selected':'' }}>Prix croissant</option>
                <option value="price_desc" {{ request('sort')==='price_desc'?'selected':'' }}>Prix décroissant</option>
                <option value="newest" {{ request('sort')==='newest'?'selected':'' }}>Plus récents</option>
              </select>
            </div>

            <button type="submit" class="btn btn-danger btn-sm w-100">Appliquer</button>
            <a href="{{ route('search', ['q' => $query]) }}" class="btn btn-outline-secondary btn-sm w-100 mt-1">Réinitialiser filtres</a>
          </form>
        </div>
      </div>
    </div>

    <!-- Results -->
    <div class="col-lg-9">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h5 fw-bold mb-0">
          Résultats pour "<span class="text-danger">{{ e($query) }}</span>"
          @if($engine)
            <span class="badge bg-success ms-2 fw-normal small">{{ $engine->carModel->make->name }} {{ $engine->carModel->name }}</span>
          @endif
        </h1>
        <span class="text-muted small">{{ $products instanceof \Illuminate\Pagination\LengthAwarePaginator ? $products->total() : $products->count() }} résultat(s)</span>
      </div>

      @if($products->count())
        <div class="row g-3">
          @foreach($products as $product)
          <div class="col-6 col-md-4">
            @include('components.product-card', compact('product'))
          </div>
          @endforeach
        </div>
        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
          <div class="mt-4">{{ $products->links() }}</div>
        @endif
      @else
        <div class="text-center py-5">
          <i class="fas fa-search fa-4x text-muted mb-4"></i>
          <h4 class="text-muted">Aucun résultat pour "{{ e($query) }}"</h4>
          <p class="text-muted">Essayez avec des termes différents, une référence, ou parcourez notre catalogue.</p>
          @if($engine)
            <p class="text-muted small">Vous pouvez également <a href="{{ route('vehicle.clear') }}" class="text-danger">effacer le filtre véhicule</a> et relancer la recherche.</p>
          @endif
          <a href="{{ route('home') }}" class="btn btn-danger mt-2"><i class="fas fa-home me-1"></i>Retour à l'accueil</a>
        </div>
      @endif
    </div>
  </div>
  @else
  <!-- Empty state with suggestions -->
  <div class="row g-4">
    <div class="col-md-8 mx-auto text-center py-4">
      <i class="fas fa-search fa-4x text-muted mb-4"></i>
      <h3 class="text-muted mb-3">Que recherchez-vous ?</h3>
      <p class="text-muted">Saisissez le nom d'une pièce, une référence constructeur, ou une marque (Bosch, NGK, KYB...)</p>
    </div>
  </div>
  @endif
</div>
@endsection
@push('scripts')
<script>
// Autocomplete
const searchInput = document.querySelector('input[name="q"]');
if (searchInput) {
  let timeout;
  searchInput.addEventListener('input', function() {
    clearTimeout(timeout);
    const q = this.value.trim();
    if (q.length < 2) return;
    timeout = setTimeout(() => {
      fetch(`{{ route('search') }}?q=${encodeURIComponent(q)}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(r => r.json())
      .then(data => { /* Could render dropdown */ })
      .catch(() => {});
    }, 300);
  });
}
</script>
@endpush
