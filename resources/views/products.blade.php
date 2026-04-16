<div class="d-flex gap-2 mt-2" id="color-swatches">
    @foreach ($product->availableColors as $color)
    <button type="button" class="color-swatch"
        style="width:36px;height:36px;background:{{ $color['hex'] ?? '#ccc' }};
               border:2px solid #ddd;border-radius:50%;cursor:pointer"
        data-color="{{ $color['name'] }}" title="{{ $color['name'] }}">
    </button>
    @endforeach
</div>

{{-- Size buttons --}}
<div class="d-flex gap-2 mt-2" id="size-buttons">
    @foreach ($product->availableSizes as $size)
    <button type="button" class="size-btn btn btn-outline-dark" data-size="{{ $size }}">
        {{ $size }}
    </button>
    @endforeach
</div>

{{-- Embedded variant JSON for JavaScript --}}
<script id="variants-json" type="application/json">
    {!! json_encode($product->variants->map(fn($v) => [
        'id'         => $v->id,
        'size'       => $v->size,
        'color'      => $v->color,
        'stock'      => $v->stock,
        'finalPrice' => $v->final_price,
    ])->values()) !!}
</script>

{{-- Form --}}
<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="variant_id" id="selected-variant-id" value="">
    <button type="submit" id="add-cart-btn" class="btn btn-dark" disabled>
        Pilih Ukuran & Warna Dulu
    </button>
</form>

@push('scripts')
<script>
const VARIANTS = JSON.parse(document.getElementById("variants-json").textContent);
let selColor = null, selSize = null;

function updateVariantUI() {
    if (!selColor || !selSize) return;
    const v   = VARIANTS.find(x => x.size === selSize && x.color === selColor);
    const btn = document.getElementById("add-cart-btn");
    if (!v) { btn.disabled = true; btn.textContent = "Varian tidak tersedia"; return; }
    document.getElementById("selected-variant-id").value = v.id;
    document.getElementById("variant-price").textContent = "Rp " + v.finalPrice.toLocaleString("id-ID");
    btn.disabled    = v.stock === 0;
    btn.textContent = v.stock > 0 ? "Tambah ke Keranjang" : "Stok Habis";
}

document.querySelectorAll(".color-swatch").forEach(b => b.addEventListener("click", function() {
    document.querySelectorAll(".color-swatch").forEach(x => x.style.border = "2px solid #ddd");
    this.style.border = "3px solid #000";
    selColor = this.dataset.color; updateVariantUI();
}));

document.querySelectorAll(".size-btn").forEach(b => b.addEventListener("click", function() {
    document.querySelectorAll(".size-btn").forEach(x => { x.classList.remove("btn-dark"); x.classList.add("btn-outline-dark"); });
    this.classList.replace("btn-outline-dark","btn-dark");
    selSize = this.dataset.size; updateVariantUI();
}));
</script>
@endpush