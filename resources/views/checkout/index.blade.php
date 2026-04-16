<div class="card mb-4">
    <div class="card-header fw-bold">Payment Method</div>
    <div class="card-body">
        <div class="form-check border rounded p-3 mb-2">
            <input class="form-check-input" type="radio" name="payment_gateway" value="midtrans" checked>
            <label class="form-check-label">
                <strong>Midtrans</strong> <span class="badge bg-success">Recommended</span>
                <div class="text-muted small">GoPay · QRIS · Transfer Bank · Indomaret · Alfamart</div>
            </label>
        </div>
        <div class="form-check border rounded p-3">
            <input class="form-check-input" type="radio" name="payment_gateway" value="stripe">
            <label class="form-check-label">
                <strong>Credit/Debit Card</strong>
                <div class="text-muted small">Visa · Mastercard · International Cards</div>
            </label>
        </div>
    </div>
</div>
<div id="midtrans-wrapper">
    <button id="pay-midtrans-btn" class="btn btn-dark w-100 py-3">Pay via Midtrans</button>
</div>
<div id="stripe-wrapper" class="d-none">
    <div id="stripe-payment-element" class="border rounded p-3 mb-3"></div>
    <button id="pay-stripe-btn" class="btn btn-primary w-100 py-3">Pay with Card</button>
</div>
