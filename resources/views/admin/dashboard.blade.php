@extends('layouts.admin')
@section('content')

@if ($stockAlerts->count() > 0)
<div class="card shadow-sm mb-4" style="border-left:4px solid #E94560">
    <div class="card-header fw-bold" style="background:#FFF5F5">
        ⚠️ Stock is running low ({{ $stockAlerts->count() }} variant)
    </div>
    <div class="table-responsive">
        <table class="table table-sm mb-0">
            <thead><tr><th>Product</th><th>Variant</th><th>Stock</th><th>Update</th></tr></thead>
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

{{-- KPI Cards --}}
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;background:#16A34A22;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px">💰</div>
                <div>
                    <p class="text-muted small mb-0">Total Revenue</p>
                    <h5 class="fw-bold mb-0 text-success">{{ idr($kpi['revenue_total']) }}</h5>
                    <small class="text-muted">Today: {{ idr($kpi['revenue_today']) }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;background:#2563EB22;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px">📦</div>
                <div>
                    <p class="text-muted small mb-0">Total Orders</p>
                    <h5 class="fw-bold mb-0">{{ $kpi['orders_total'] }}</h5>
                    <small class="text-warning fw-bold">{{ $kpi['orders_pending'] }} pending</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;background:#7C3AED22;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px">👥</div>
                <div>
                    <p class="text-muted small mb-0">Customers</p>
                    <h5 class="fw-bold mb-0">{{ $kpi['customers_total'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm {{ $kpi['low_stock_count'] > 0 ? 'border-danger' : '' }}">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;background:#E9456022;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px">⚠️</div>
                <div>
                    <p class="text-muted small mb-0">Stock is running low</p>
                    <h5 class="fw-bold mb-0 text-danger">{{ $kpi['low_stock_count'] }}</h5>
                    <small class="text-danger">{{ $kpi['out_of_stock'] }} out of stock total</small>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Revenue Chart --}}
<div class="card shadow-sm mb-4">
    <div class="card-header fw-bold">Last 30 Days Revenue</div>
    <div class="card-body"><canvas id="revenueChart" height="80"></canvas></div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById("revenueChart"), {
    type: "line",
    data: {
        labels: {!! json_encode($revenueChart->pluck("date")) !!},
        datasets: [{ label: "Revenue",
            data:  {!! json_encode($revenueChart->pluck("revenue")) !!},
            borderColor:"#1A1A2E", backgroundColor:"rgba(26,26,46,0.07)",
            tension:0.4, fill:true, pointBackgroundColor:"#E94560", pointRadius:3
        }]
    },
    options:{ responsive:true, plugins:{legend:{display:false}},
        scales:{ y:{ ticks:{ callback: v => "Rp "+v.toLocaleString("id-ID") } } } }
});
</script>
@endpush
@endsection
