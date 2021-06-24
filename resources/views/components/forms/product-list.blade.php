<tr>
    @if($canView('product'))
        <td>
            <x-select name='pid[]' placeholder='Choose...' :option='$option' :bind='$product' select2 />
        </td>
    @endif

    @if($canView('location'))
        <td>
            <x-select name="locationID[]" placeholder='Choose...' :option='$product ? [$product->locationID => $product->locationText] : []' :bind='$product' />
        </td>
    @endif

    @if($canView('quantity'))
        <td>
            <x-input name="amount[]" type="number" class="text-right sum" margin='mb-0' step='0.001' :bind='$product' />
        </td>
    @endif

    @if($canView('stock'))
        <td>
            <x-input name="stock[]" type="number" class="text-right stock" margin='mb-0' step='0.001' :bind='$product' readonly />
        </td>
    @endif

</tr>