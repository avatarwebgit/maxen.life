<div class="form-row">
    <div class="form-group col-md-4">
        <label for="name">نماد</label>
        <input class="form-control" id="image" name="image" type="file">
    </div>

    <div class="form-group col-md-4">
        <label title="مقدار بیعانه برحسب درصد بر روی قیمت کل فاکتور" for="deposit_percent">بیعانه (%)</label>
        <input class="form-control" id="deposit_percent" name="deposit_percent" type="number" min="0" max="100" value="{{ $payment->deposit_percent }}">
    </div>
</div>
