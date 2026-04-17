@extends('layouts.admin')
@section('page-title','Modifier: '.Str::limit($produit->name, 40))
@section('content')
<form action="{{ route('admin.produits.update', $produit) }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="row g-4">
    <div class="col-md-8">
      <!-- General Info -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Informations générales</h5></div>
        <div class="card-body">
          <div class="mb-3">
            <label class="fw-semibold small">Nom du produit *</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $produit->name }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="fw-semibold small">Catégorie *</label>
              <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">Choisir...</option>
                @foreach($categories as $c)
                  <option value="{{ $c->id }}" {{ $produit->category_id == $c->id ? 'selected' : '' }}>
                    {{ $c->parent ? $c->parent->name . ' › ' : '' }}{{ $c->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="fw-semibold small">Marque de pièce</label>
              <input type="text" name="brand" class="form-control" value="{{ $produit->brand }}" placeholder="Bosch, NGK, KYB...">
            </div>
            <div class="col-md-6">
              <label class="fw-semibold small">Référence</label>
              <input type="text" name="reference" class="form-control" value="{{ $produit->reference }}">
            </div>
            <div class="col-md-6">
              <label class="fw-semibold small">Référence OEM</label>
              <input type="text" name="oem_reference" class="form-control" value="{{ $produit->oem_reference }}">
            </div>
          </div>
          <div class="mt-3">
            <label class="fw-semibold small">Description</label>
            <textarea name="description" class="form-control" rows="5">{{ $produit->description }}</textarea>
          </div>
          <div class="mt-3">
            <label class="fw-semibold small">Spécifications techniques</label>
            <textarea name="technical_specs" class="form-control" rows="3" placeholder="Dimensions, poids, normes...">{{ $produit->technical_specs }}</textarea>
          </div>
        </div>
      </div>

      <!-- Images gallery -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Galerie d'images</h5></div>
        <div class="card-body">
          <div class="row g-2 mb-3">
            @foreach($images as $img)
            <div class="col-3">
              <div class="position-relative border rounded p-1" style="background:#f8f9fa">
                <img src="{{ Storage::url($img->path) }}" style="width:100%;height:90px;object-fit:contain" alt="Image">
                <form action="{{ route('admin.produits.images.delete', $img) }}" method="POST">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 py-0 px-1" onclick="return confirm('Supprimer cette image ?')" style="font-size:10px">✕</button>
                </form>
              </div>
            </div>
            @endforeach
            @if($images->isEmpty())
              <div class="col-12 text-muted small">Aucune image en galerie.</div>
            @endif
          </div>
          <form action="{{ route('admin.produits.images.upload', $produit) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
              <input type="file" name="image" class="form-control form-control-sm" accept="image/*" required>
              <button type="submit" class="btn btn-outline-danger btn-sm">Ajouter image</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <!-- Price & Stock -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Prix & Stock</h5></div>
        <div class="card-body">
          <div class="mb-3">
            <label class="fw-semibold small">Prix (TND) *</label>
            <input type="number" name="price" step="0.001" min="0" class="form-control @error('price') is-invalid @enderror" value="{{ $produit->price }}" required>
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <label class="fw-semibold small">Ancien prix (TND) <span class="text-muted small">pour barré</span></label>
            <input type="number" name="price_old" step="0.001" min="0" class="form-control" value="{{ $produit->price_old }}">
          </div>
          <div class="mb-3">
            <label class="fw-semibold small">Stock *</label>
            <input type="number" name="stock" min="0" class="form-control @error('stock') is-invalid @enderror" value="{{ $produit->stock }}" required>
            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
      </div>

      <!-- Thumbnail -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Image principale</h5></div>
        <div class="card-body">
          @if($produit->thumbnail)
            <div class="text-center mb-2 p-2" style="background:#f8f9fa;border-radius:8px">
              <img src="{{ Storage::url($produit->thumbnail) }}" style="max-height:100px;max-width:100%;object-fit:contain" alt="Thumbnail">
            </div>
          @endif
          <input type="file" name="thumbnail" class="form-control form-control-sm" accept="image/*">
          <div class="text-muted small mt-1">Format recommandé: 600×600px JPG/PNG/WebP</div>
        </div>
      </div>

      <!-- Options -->
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Options</h5></div>
        <div class="card-body">
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ $produit->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Actif (visible sur le site)</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ $produit->is_featured ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">En vedette (page d'accueil)</label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_new" value="1" id="is_new" {{ $produit->is_new ? 'checked' : '' }}>
            <label class="form-check-label" for="is_new">Badge "Nouveau"</label>
          </div>
          <div>
            <label class="fw-semibold small">Ordre d'affichage</label>
            <input type="number" name="sort_order" class="form-control form-control-sm" value="{{ $produit->sort_order }}">
          </div>
        </div>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-danger fw-bold py-2">
          <i class="fas fa-save me-1"></i>Enregistrer les modifications
        </button>
        <a href="{{ route('admin.produits.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <form action="{{ route('admin.produits.destroy', $produit) }}" method="POST">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Archiver ce produit ?')">
            <i class="fas fa-archive me-1"></i>Archiver le produit
          </button>
        </form>
      </div>
    </div>
  </div>
</form>
@endsection
