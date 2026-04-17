@extends('layouts.app')
@section('title', $product->name . ' - AutoPart')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
      <li class="breadcrumb-item"><a href="{{ route('catalog.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
      <li class="breadcrumb-item active">{{ Str::limit($product->name,40) }}</li>
    </ol>
  </nav>

  <div class="row g-4">
    <!-- Images -->
    <div class="col-md-5">
      <div class="card border-0 shadow-sm mb-2">
        <div class="card-body p-3 text-center" style="height:350px;display:flex;align-items:center;justify-content:center;background:#f8f9fa">
          @if($product->thumbnail)
            <img src="{{ Storage::url($product->thumbnail) }}" id="mainImage" alt="{{ $product->name }}" style="max-height:320px;max-width:100%;object-fit:contain">
          @else
            <i class="fas fa-image fa-5x text-muted"></i>
          @endif
        </div>
      </div>
      @if($product->images->count())
      <div class="d-flex gap-2 flex-wrap">
        @if($product->thumbnail)
          <img src="{{ Storage::url($product->thumbnail) }}" onclick="document.getElementById('mainImage').src=this.src" class="rounded border cursor-pointer" style="height:60px;width:60px;object-fit:contain;cursor:pointer;background:#f8f9fa">
        @endif
        @foreach($product->images as $img)
          <img src="{{ Storage::url($img->path) }}" onclick="document.getElementById('mainImage').src=this.src" class="rounded border cursor-pointer" style="height:60px;width:60px;object-fit:contain;cursor:pointer;background:#f8f9fa">
        @endforeach
      </div>
      @endif
    </div>

    <!-- Info -->
    <div class="col-md-7">
      <div class="mb-1"><span class="badge bg-secondary">{{ $product->category->name }}</span> @if($product->brand)<span class="badge bg-light text-dark border ms-1">{{ $product->brand }}</span>@endif</div>
      <h1 class="h3 fw-bold">{{ $product->name }}</h1>
      @if($product->reference)<p class="text-muted small mb-1">Référence: <strong>{{ $product->reference }}</strong></p>@endif
      @if($product->oem_reference)<p class="text-muted small mb-2">OEM: {{ $product->oem_reference }}</p>@endif

      <div class="my-3">
        <span class="fs-2 fw-bold text-danger">{{ number_format($product->price,3) }} TND</span>
        @if($product->price_old)<span class="text-muted text-decoration-line-through ms-2">{{ number_format($product->price_old,3) }} TND</span>@endif
        @if($product->discount_percent)<span class="badge bg-danger ms-2">-{{ $product->discount_percent }}%</span>@endif
      </div>

      @if($product->is_in_stock)
        <div class="mb-3"><span class="badge bg-success"><i class="fas fa-check me-1"></i>En stock ({{ $product->stock }} disponibles)</span></div>
        <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2 mb-4">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width:80px">
          <button type="submit" class="btn btn-danger px-4"><i class="fas fa-cart-plus me-2"></i>Ajouter au panier</button>
        </form>
      @else
        <div class="alert alert-warning"><i class="fas fa-exclamation-circle me-1"></i>Article temporairement indisponible</div>
      @endif

      <!-- WhatsApp CTA -->
      <a href="https://wa.me/21623136136?text=Bonjour, je recherche: {{ urlencode($product->name.' - Ref:'.$product->reference) }}" target="_blank" class="btn btn-success mb-3">
        <i class="fab fa-whatsapp me-2"></i>Commander sur WhatsApp
      </a>

      @if($engine)
      <div class="alert alert-success-subtle border-success-subtle small">
        <i class="fas fa-check-circle text-success me-1"></i>Compatible avec votre {{ $engine->carModel->make->name }} {{ $engine->carModel->name }}
      </div>
      @endif

      <!-- Compatible vehicles -->
      @if($product->engines->count())
      <div class="mt-3">
        <h6 class="fw-bold">Véhicules compatibles ({{ $product->engines->count() }})</h6>
        <div style="max-height:150px;overflow-y:auto">
          @foreach($product->engines->groupBy(fn($e)=>$e->carModel->make->name ?? '') as $makeName=>$engines)
            <div class="small mb-1"><strong>{{ $makeName }}:</strong>
              @foreach($engines as $eng)
                <span class="badge bg-light text-dark border me-1">{{ $eng->carModel->name }} {{ $eng->full_name }}</span>
              @endforeach
            </div>
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </div>

  <!-- Description & Specs tabs -->
  @if($product->description || $product->technical_specs)
  <div class="mt-5">
    <ul class="nav nav-tabs" id="productTabs">
      <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc">Description</button></li>
      @if($product->technical_specs)<li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#specs">Spécifications</button></li>@endif
    </ul>
    <div class="tab-content p-3 border border-top-0 rounded-bottom">
      <div class="tab-pane active" id="desc">{!! nl2br(e($product->description)) !!}</div>
      @if($product->technical_specs)<div class="tab-pane" id="specs"><pre class="mb-0">{{ $product->technical_specs }}</pre></div>@endif
    </div>
  </div>
  @endif

  <!-- Related products -->
  @if($related->count())
  <div class="mt-5">
    <h4 class="fw-bold mb-3">Produits similaires</h4>
    <div class="row g-3">
      @foreach($related as $product) <div class="col-6 col-md-3">@include('components.product-card', compact('product'))</div> @endforeach
    </div>
  </div>
  @endif
</div>
@endsection
