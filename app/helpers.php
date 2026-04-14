<?php

// Format integer as Indonesian Rupiah
// idr(150000) → "Rp 150.000"
// idr(2500000) → "Rp 2.500.000"
function idr(int $amount): string
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}