@extends('layouts.admin')
@section('page-title','Modifier catégorie')
@section('content')
<div class="col-md-6">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form action="{{ route('admin.categories.update',$category) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3"><label class="fw-semibold small">Nom *</label><input type="text" name="name" class="form-control" value="{{ $category->name }}" required></div>
        <div class="mb-3"><label class="fw-semibold small">Catégorie parente</label><select name="parent_id" class="form-select"><option value="">— Racine —</option>@foreach($parents as $p)<option value="{{ $p->id }}" {{ $category->parent_id==$p->id?'selected':'' }}>{{ $p->name }}</option>@endforeach</select></div>
        <div class="mb-3"><label class="fw-semibold small">Description</label><textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea></div>
        <div class="mb-3"><label class="fw-semibold small">Image</label>@if($category->image)<img src="{{ Storage::url($category->image) }}" class="d-block mb-2" style="height:60px;object-fit:contain;background:#f8f9fa">@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
        <div class="mb-3"><label class="fw-semibold small">Ordre</label><input type="number" name="sort_order" class="form-control" value="{{ $category->sort_order }}"></div>
        <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $category->is_active?'checked':'' }}><label class="form-check-label">Actif</label></div>
        <button type="submit" class="btn btn-danger w-100">Enregistrer</button>
      </form>
    </div>
  </div>
</div>
@endsection
