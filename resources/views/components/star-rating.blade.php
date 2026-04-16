@props(['rating'=>0, 'interactive'=>false, 'name'=>'rating'])

@if ($interactive)
<div class="star-input" style="display:flex;flex-direction:row-reverse;width:fit-content">
    @for ($i = 5; $i >= 1; $i--)
    <input type="radio" id="{{ $name }}_{{ $i }}" name="{{ $name }}" value="{{ $i }}"
           class="visually-hidden" {{ old($name,5)==$i ? 'checked' : '' }} required>
    <label for="{{ $name }}_{{ $i }}" style="font-size:32px;cursor:pointer;color:#ddd">★</label>
    @endfor
</div>
<style>
.star-input input:checked ~ label,.star-input label:hover,.star-input label:hover ~ label{color:#FFB800}
.star-input label{transition:color .1s}
</style>
@else
<span>
    @for ($i = 1; $i <= 5; $i++)
    <span style="color:{{ $i <= $rating ? '#FFB800' : '#ddd' }};font-size:20px">★</span>
    @endfor
</span>
@endif