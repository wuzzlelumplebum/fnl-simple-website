<div id="variants-container">
    <div class="variant-row border rounded p-3 mb-2" data-index="0">
        <div class="row g-2 align-items-end">
            <div class="col-md-2">
                <label>Ukuran</label>
                <select name="variants[0][size]" class="form-select form-select-sm">
                    <option>S</option><option selected>M</option>
                    <option>L</option><option>XL</option><option>XXL</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Color Name</label>
                <input type="text" name="variants[0][color]" class="form-control form-control-sm" placeholder="Black" required>
            </div>
            <div class="col-md-2">
                <label>Color Code</label>
                <input type="color" name="variants[0][color_hex]" class="form-control form-control-color" value="#000000">
            </div>
            <div class="col-md-2">
                <label>Stock</label>
                <input type="number" name="variants[0][stock]" class="form-control form-control-sm" value="10" min="0">
            </div>
            <div class="col-md-2">
                <label>Price Adjustment (Rp)</label>
                <input type="number" name="variants[0][price_adjustment]" class="form-control form-control-sm" value="0">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-variant">✕</button>
            </div>
        </div>
    </div>
</div>

<button type="button" id="add-variant-btn" class="btn btn-success btn-sm mt-2">+ Add Variant</button>

@push('scripts')
<script>
let vi = 1;
document.getElementById("add-variant-btn").addEventListener("click", () => {
    const tmpl = document.querySelector(".variant-row");
    const row  = tmpl.cloneNode(true);
    row.dataset.index = vi;
    row.querySelectorAll("[name]").forEach(el => {
        el.name = el.name.replace(/\[0\]/, `[${vi}]`);
        if (el.type !== "color") el.value = el.type === "number" ? "0" : "";
    });
    document.getElementById("variants-container").appendChild(row);
    vi++;
});
document.addEventListener("click", e => {
    if (!e.target.classList.contains("remove-variant")) return;
    if (document.querySelectorAll(".variant-row").length > 1)
        e.target.closest(".variant-row").remove();
});
</script>
@endpush