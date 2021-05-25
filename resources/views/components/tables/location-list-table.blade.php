<table id="material" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th class='text-center'>Location</th>
            <th class='text-center' width='20%'>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @if($products->isNotEmpty())
            @foreach($products as $product)
                <x-forms.location-list :product='$product' />
            @endforeach
        @endif
        <x-forms.location-list />
    </tbody>
</table>

@push('js')
    <script>
        /**
         * Functions to display the total product quantity
         */
        $.fn.displayTotal = function () {
            var result = 0

            $(".sum").each(function () {
                result += parseFloat($(this).val());
            });

            var used = $('input[name="materialUse"]').val();

            var loss = used - result;

            $("label[for = total").text("Material Weight : " + result + " Kg");
            $('input[name="materialLoss"]').val(Number.parseFloat(loss.toFixed(3)));
        };

        /** 
         * Setup Datatable
         */
        var dtable = $('#material').DataTable({
            paging: false,
            info: false,
            lengthChange: false,
            searching: false
        });

        var locations = {
            placeholder: "Choose Location ",
            ajax: {
                delay: 250,
                url: '{{ route("api.rack") }}',
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (obj) {
                            return {
                                id: obj.id,
                                text: obj.code
                            };
                        })
                    };
                }
            }
        }

        $('#material tbody').on('change', 'td', function (e) {
            var lenght = dtable.page.info().recordsTotal;
            var index = dtable.row(this).index();
            var product = dtable.row(this).nodes().to$().find('.cselect').val();

            // add row if has change and not empty
            if (product) {
                if (index == lenght - 1) {
                    dtable.row.add(dtable.row(this).data()).draw();
                    dtable.row(index + 1).nodes().to$().find('select[name="product_location[]"]').select2(locations);
                    dtable.row(index + 1).nodes().to$().find('input[name="product_quantity[]"]').val(0);
                }
            } else {
                if (index != lenght - 1) {
                    dtable.row(this).remove().draw();
                }
            }
        });

        $('#material tbody').on('keyup', 'input[name="product_quantity[]"]', function (e) {
            var tr = $(this).closest("tr");
            var value = dtable.row(tr).nodes().to$().find('.sum').val();

            // Check is empty and put default number
            if (value == '') {
                dtable.row(tr).nodes().to$().find('.sum').val(0);
            }

            $(this).displayTotal();
        });

        $(document).ready(function () {
            $('select[name="product_location[]"]').select2(locations);
            $(this).displayTotal();
        });

    </script>
@endpush
