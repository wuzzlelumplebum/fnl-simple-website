@if ($stockAlerts->count() > 0)
<div class="card shadow-sm mb-4" style="border-left:4px solid #E94560">
    <div class="card-header fw-bold" style="background:#FFF5F5">
        ⚠️ Stok Menipis ({{ $stockAlerts->count() }} variant)
    </div>
    <div class="table-responsive">
        <table class="table table-sm mb-0">
            <thead><tr><th>Produk</th><th>Variant</th><th>Stok</th><th>Update</th></tr></thead>
            <tbody>
                @foreach ($stockAlerts as $alert)
                <tr class="{{ $alert->current_stock === 0 ? 'table-danger' : 'table-warning' }}">
                    <td class="fw-bold">{{ $alert->product_name }}</td>
                    <td><span class="badge bg-secondary">{{ $alert->variant_label }}</span></td>
                    <td>
                        @if ($alert->current_stock === 0)
                            <span class="badge bg-danger">HABIS</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $alert->current_stock }} pcs</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.variants.stock', $alert->variant_id) }}" method="POST" class="d-flex gap-1">
                            @csrf @method('PATCH')
                            <input type="number" name="stock" min="0" class="form-control form-control-sm" style="width:70px">
                            <button class="btn btn-sm btn-dark">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif