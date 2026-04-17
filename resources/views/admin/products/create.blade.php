@extends('layouts.admin')
@section('page-title','Nouveau produit')
@section('content')
<form action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-md-8">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Informations générales</h5>
          <div class="mb-3"><label class="fw-semibold small">Nom du produit *</label><input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required><div class="invalid-feedback">{{ $errors->first('name') }}</div></div>
          <div class="row g-3">
            <div class="col-md-6"><label class="fw-semibold small">Catégorie *</label><select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required><option value="">Choisir...</option>@foreach($categories as $c)<option value="{{ $c->id }}" {{ old('category_id')==$c->id?'selected':'' }}>{{ $c->parent?$c->parent->name.' > ':'' }}{{ $c->name }}</option>@endforeach</select></div>
            <div class="col-md-6"><label class="fw-semibold small">Marque de pièce</label><input type="text" name="brand" class="form-control" value="{{ old('brand') }}" placeholder="Bosch, NGK, KYB..."></div>
            <div class="col-md-6"><label class="fw-semibold small">Référence</label><input type="text" name="reference" class="form-control" value="{{ old('reference') }}"></div>
            <div class="col-md-6"><label class="fw-semibold small">Référence OEM</label><input type="text" name="oem_reference" class="form-control" value="{{ old('oem_reference') }}"></div>
          </div>
          <div class="mt-3"><label class="fw-semibold small">Description</label><textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea></div>
          <div class="mt-3"><label class="fw-semibold small">Spécifications techniques</label><textarea name="technical_specs" class="form-control" rows="3" placeholder="Dimensions, poids, normes...">{{ old('technical_specs') }}</textarea></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Prix & Stock</h5>
          <div class="mb-3"><label class="fw-semibold small">Prix (TND) *</label><input type="number" name="price" step="0.001" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required></div>
          <div class="mb-3"><label class="fw-semibold small">Ancien prix (TND)</label><input type="number" name="price_old" step="0.001" class="form-control" value="{{ old('price_old') }}"></div>
          <div class="mb-3"><label class="fw-semibold small">Stock *</label><input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock',0) }}" required></div>
        </div>
      </div>
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Image principale</h5>
          <input type="file" name="thumbnail" class="form-control" accept="image/*">
        </div>
      </div>
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Options</h5>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked><label class="form-check-label" for="is_active">Actif</label></div>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"><label class="form-check-label" for="is_featured">En vedette</label></div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="is_new" value="1" id="is_new"><label class="form-check-label" for="is_new">Nouveau</label></div>
          <div class="mt-3"><label class="fw-semibold small">Ordre d'affichage</label><input type="number" name="sort_order" class="form-control form-control-sm" value="0"></div>
        </div>
      </div>
      <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">Créer le produit</button>
    </div>
  </div>
</form>
@endsection
