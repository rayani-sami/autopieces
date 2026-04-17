<div class="card h-100 border-0 shadow-sm product-card">
  <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
    <div class="product-img-wrap bg-light" style="height:180px;overflow:hidden">
      @if($product->thumbnail)
        <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="card-img-top" style="height:180px;object-fit:contain;padding:10px">
      @else
        <div class="d-flex align-items-center justify-content-center h-100 text-muted"><i class="fas fa-image fa-3x"></i></div>
      @endif
    </div>
  </a>
  @if($product->discount_percent)
    <span class="badge bg-danger position-absolute top-0 end-0 m-2">-{{ $product->discount_percent }}%</span>
  @endif
  @if($product->is_new)
    <span class="badge bg-success position-absolute top-0 start-0 m-2">Nouveau</span>
  @endif
  <div class="card-body p-3">
    <div class="text-muted small mb-1">{{ $product->brand }}</div>
    <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
      <h6 class="card-title fw-semibold mb-1" style="font-size:13px;line-height:1.3">{{ Str::limit($product->name,60) }}</h6>
    </a>
    @if($product->reference)
      <div class="text-muted" style="font-size:11px">Réf: {{ $product->reference }}</div>
    @endif
    <div class="mt-2 d-flex align-items-center justify-content-between">
      <div>
        <span class="fw-bold text-danger fs-6">{{ number_format($product->price,3) }} TND</span>
        @if($product->price_old)<br><small class="text-muted text-decoration-line-through">{{ number_format($product->price_old,3) }} TND</small>@endif
      </div>
      @if($product->is_in_stock)
        <span class="badge bg-success-subtle text-success small">En stock</span>
      @else
        <span class="badge bg-danger-subtle text-danger small">Rupture</span>
      @endif
    </div>
    @if($product->is_in_stock)
    <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">
      <input type="hidden" name="quantity" value="1">
      <button type="submit" class="btn btn-danger btn-sm w-100"><i class="fas fa-cart-plus me-1"></i>Ajouter au panier</button>
    </form>
    @else
      <button class="btn btn-secondary btn-sm w-100 mt-2" disabled>Indisponible</button>
    @endif
  </div>
</div>
