<div class="custom-checkbox">
    <?php $quotePart = $quote->parts()->whereId($part['id'])->first(); ?>
    <input @if(in_array($part['id'], $quote->parts->pluck('id')->toArray())) checked @endif type="checkbox" name="parts[{{$part['id']}}][part_id]" value="{{ $part['id'] }}" id="part_{{ $part['id'] }}"/>
    <label for="part_{{ $part['id'] }}">{{ $part->part_name }}</label>
    <div class="parts-quantity-price">
        <p style="color: {{ in_array($part['id'], $quote->parts->pluck('id')->toArray()) ? '#4BFF00' : 'grey' }}">
            Total Price: $<span class="total_price">{{ $quotePart ? number_format($quotePart->pivot->part_total, 2) : '0.00' }}</span>
        </p>
    </div>
    <div class="add-parts-dropdown">
        {{-- <input class="unit_price" type="hidden" value="{{ $part->unit_price }}"> --}}
        <input name="parts[{{$part['id']}}][part_name]" type="hidden" value="{{ $part['part_name'] }}">
        <input name="parts[{{$part['id']}}][position]" type="hidden" value="{{ $part['position'] }}">
        <div class="form-group">
            <span>Select Quantity</span>

            <input type="text" list="quantity_{{$part['id']}}" id="part_quantity_{{$part['id']}}" name="parts[{{$part['id']}}][quantity]" class="form-control part_quantity" value="{{ $quotePart ? $quotePart->pivot->part_quantity : '0' }}" min="0" minlength="1" />
            <datalist id="quantity_{{$part['id']}}">
                @for ($i = 1; $i <= 25; $i++)
                    <option value="{{$i}}">
                @endfor
            </datalist>
        </div>
        <div class="form-group">
            <span>Total Price</span>
            <input name="parts[{{$part['id']}}][total_price]" id="total_price_{{$part['id']}}" type="text" class="form-control total_price" value="{{  $quotePart ? $quotePart->pivot->part_total : '0.00' }}" />
        </div>
        <div class="add-part-btn">
            <button type="button" class="btn-primary">Add</button>
        </div>
    </div>
</div>
