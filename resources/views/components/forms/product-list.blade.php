<tr>
    <td>
        <x-select name='product_id[]' :option='$option' :selected='[$product_id]'/>
    </td>
    <td>
        <x-select name="product_location[]" :placeholderKey='$product_location' :placeholder='$product_location_text' />
    </td>
    <td>
        <x-input name="product_quantity[]" type="number" class="text-right sum" margin='mb-0' step='0.001' :value='$product_quantity' />
    </td>
    
    @if($viewStock)
    <td>
        <x-input name="product_stock[]" type="number" class="text-right stock" margin='mb-0' step='0.001' :value='$product_stock' readonly />
    </td>
    @endif
    
</tr>
