@php
$steps=['pending','confirmed','processing','shipped','delivered'];
$currentStep=$order->status_step;
$pct=$currentStep>0?($currentStep/(count($steps)-1))*100:0;
@endphp

<div class="position-relative d-flex justify-content-between mb-5 px-2" style="margin-top:16px">
    {{-- Grey track --}}
    <div style="position:absolute;top:16px;left:0;right:0;height:4px;background:#e9ecef;z-index:0"></div>
    {{-- Filled track --}}
    <div style="position:absolute;top:16px;left:0;width:{{ $pct }}%;height:4px;background:#1A1A2E;z-index:1"></div>

    @foreach (['Waiting','Confirmed','Processing','Shipped','Delivered'] as $i => $label)
    @php $done = $i <= $currentStep; @endphp
    <div class="d-flex flex-column align-items-center" style="z-index:2;flex:1">
        <div class="rounded-circle d-flex align-items-center justify-content-center"
             style="width:34px;height:34px;
                    background:{{ $done ? '#1A1A2E' : '#e9ecef' }};
                    color:{{ $done ? 'white' : '#adb5bd' }};font-size:14px">
            <i class="bi bi-{{ ['clock','check-circle','box-seam','truck','house-check'][$i] }}"></i>
        </div>
        <small class="mt-2 text-center" style="font-size:11px;font-weight:600;
               color:{{ $done ? '#1A1A2E' : '#adb5bd' }}">{{ $label }}</small>
    </div>
    @endforeach
</div>

{{-- Event log --}}
@foreach ($order->tracking as $event)
<div class="d-flex gap-3 pb-3 border-bottom">
    <div class="text-muted" style="font-size:12px;min-width:120px">
        {{ $event->occurred_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
    </div>
    <div>
        <div class="fw-bold">{{ $event->title }}</div>
        <div class="text-muted small">{{ $event->description }}</div>
    </div>
</div>
@endforeach