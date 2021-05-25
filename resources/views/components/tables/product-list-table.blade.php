<table id="material" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>{{ $header }}</th>
            <th class='text-center' width='30%'>Location</th>
            <th class='text-center' width='20%'>Quantity</th>
            @if($viewStock)
                <th class='text-center' width='20%'>Stock</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if($products->isNotEmpty())
            @foreach($products as $product)
                <x-forms.product-list :option='$option' :view-stock=$viewStock :product='$product' :index='$loop->index' />
            @endforeach
        @endif
        <x-forms.product-list :option='$option' :view-stock=$viewStock />
    </tbody>
</table>

@push('js')
    <script>
        $(document).ready(function () {
            $('.cselect').select2().trigger('change');
        });

        /**
         * Functions to display the total product quantity
         */
        $.fn.displayTotal = function () {
            var total = 0
            $(".sum").each(function () {
                total += parseFloat($(this).val());
            });
            $("label[for = total").text("Material Weight : " + total + " Kg");
        };

        /**
         * Functions to get validation stock
         */
        $.fn.validationStock = function (row, value, stock) {

            value = Number.parseFloat(value);
            stock = Number.parseFloat(stock);

            if (value > stock) {
                row.nodes().to$().find('.stock').addClass("bg-warning").removeClass("bg-success");
            } else {
                row.nodes().to$().find('.stock').addClass("bg-success").removeClass("bg-warning");
            }
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

        $('#material tbody').on('change', 'td', function (e) {
            var lenght = dtable.page.info().recordsTotal;
            var index = dtable.row(this).index();
            var product = dtable.row(this).nodes().to$().find('.cselect').val();
            var value = dtable.row(this).nodes().to$().find('.sum').val();

            // add row if has change and not empty
            if (product) {
                if (index == lenght - 1) {
                    dtable.row.add(dtable.row(this).data()).draw();
                    dtable.row(index + 1).nodes().to$().find(".cselect").select2();
                }
            } else {
                if (index != lenght - 1) {
                    dtable.row(this).remove().draw();
                }
            }

            // Check is empty and put default number
            if (value == '') {
                dtable.row(this).nodes().to$().find('.sum').val(0);
            }

            $(this).displayTotal();
        });

        $('#material tbody').on('select2:select', 'select[name="product_id[]"]', function (e) {
            var tr = $(this).closest("tr");
            var rack = dtable.row(tr).nodes().to$().find('select[name="product_location[]');

            rack.val(-1).trigger('change');

            if ('{{ $isAll }}') {
                rack.select2({
                    ajax: {
                        url: '{{ route("api.rack") }}',
                        processResults: function (data) {
                            return {
                                results: $.map(data.data, function (obj) {
                                    return {
                                        id: obj.id,
                                        text: obj.code,
                                        quantity: obj.quantity
                                    };
                                })
                            };
                        }
                    }
                });
            } else {
                rack.select2({
                    ajax: {
                        url: '{{ url("api/product") }}' + '/' + $(this).val() +
                            '/racks',
                        processResults: function (data) {
                            return {
                                results: $.map(data.data, function (obj) {
                                    return {
                                        id: obj.id,
                                        text: obj.code,
                                        quantity: obj.quantity
                                    };
                                })
                            };
                        }
                    }
                });
            }
        });

        $('#material tbody').on('keyup', 'input[name="product_quantity[]"]', function (e) {
            var tr = $(this).closest("tr");

            var stock = dtable.row(tr).nodes().to$().find('input[name="product_stock[]').val();
            var quantity = dtable.row(tr).nodes().to$().find('input[name="product_quantity[]').val();

            $(this).validationStock(dtable.row(tr), quantity, stock);
        });

        $('#material tbody').on('select2:select', 'select[name="product_location[]"]', function (evt) {
            var stock = evt.params.data.quantity;

            var tr = $(this).closest("tr");
            var quantity = dtable.row(tr).nodes().to$().find('input[name="product_quantity[]').val();
            var stock = dtable.row(tr).nodes().to$().find('input[name="product_stock[]').val(Number.parseFloat(stock.toFixed(3)));

            $(this).validationStock(dtable.row(tr), quantity, stock.val());
        });


        dtable.rows().every(function (rowIdx, tableLoop, rowLoop) {
            var stock = dtable.row(rowIdx).nodes().to$().find('input[name="product_stock[]').val();
            var quantity = dtable.row(rowIdx).nodes().to$().find('input[name="product_quantity[]').val();

            $(this).validationStock(dtable.row(rowIdx), quantity, stock);
        });

    </script>
@endpush
