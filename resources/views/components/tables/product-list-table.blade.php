<table id="material" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            @if($canView('product'))
                <th>{{ $header }}</th>
            @endisset

            @if($canView('location'))
                <th class='text-center' width='30%'>Location</th>
            @endif

            @if($canView('quantity'))
                <th class='text-center' width='15%'>Quantity</th>
            @endif

            @if($canView('stock'))
                <th class='text-center' width='20%'>Stock</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @isset($products)
            @foreach($products as $product)
                <x-forms.product-list :option='$option' :only='$views' :product='$product' :racks='$racks' :index='$loop->index' />
            @endforeach
        @endisset
        <x-forms.product-list :option='$option' :only='$views' :racks='$racks' />
    </tbody>
</table>

@push('js')
    <script>
        var optselect2 = {
            placeholder: 'Choose...'
        }

        $(document).ready(function() {
            // Variables
            var $select2 = $('.select2');
            var $product = $('select[name="pid[]"]');
            var $location = $('select[name="locationID[]"]');
            var $for = $('select[name="for"]');

            // Attach plugin select2 and triger to call event change
            // $select2.select2(optselect2)
            //     .trigger('change');

            // Check if has product input and get location option
            if (!$product.length) {
                $(this).setLocationOption($location, {
                    stock: $(this).hasViewStock(),
                });
            }

            $(this).displayTotal();
        });

        $.fn.hasViewStock = function() {
            return $('input[name="stock[]"]').length ? 1 : 0;
        };

        /**
         * Functions to display the total product quantity
         */
        $.fn.displayTotal = function() {
            var $materialUsed = $('input[name="materialUsed"]');

            // Calculation each row
            var total = 0
            $(".sum").each(function() {
                total += parseFloat($(this).val());
            });

            var materialLoss = $materialUsed.val() - total;
            materialLoss = Number.parseFloat(materialLoss.toFixed(3));

            $("span[id='total'").text(' ' + total + ' Kg');
            $("input[name='materialLoss'").val(' ' + materialLoss);
        };

        /**
         * Functions to get validation stock
         */
        $.fn.validationStock = function(index) {

            stock = dtable.row(index).nodes().to$().find('input[name="stock[]"').val();
            stock = Number.parseFloat(stock);

            value = dtable.row(index).nodes().to$().find('input[name="quantity[]"').val();
            value = Number.parseFloat(value);

            if (value > stock) {
                dtable.row(index).nodes().to$().find('.stock').addClass("bg-warning").removeClass("bg-success");
            } else {
                dtable.row(index).nodes().to$().find('.stock').addClass("bg-success").removeClass("bg-warning");
            }
        };

        $.fn.setLocationOption = function($location, param) {
            $location.select2({
                placeholder: 'Choose ... ',
                ajax: {
                    url: '{{ route("api.rack") }}',
                    data: param,
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(obj) {
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
        };

        /** 
         * Setup Datatable
         */
        var dtable = $('#material').DataTable({
            paging: false,
            order: false,
            info: false,
            lengthChange: false,
            searching: false
        });

        dtable.rows().every(function(rowIdx, tableLoop, rowLoop) {
            $(this).validationStock(rowIdx);
        });

        $('#material tbody').on('change', 'td', function(e) {
            var $row = dtable.row(this);
            var $value = $row.nodes().to$().find('.sum');
            var $select = $row.nodes().to$().find('.select2');

            var length = dtable.page.info().recordsTotal;
            var index = $row.index();

            // add row if has change and not empty
            if ($select.val()) {
                if (index == length - 1) {
                    // Clone Row
                    var $nextRow = dtable.row.add($row.data()).draw();
                    var $location = $nextRow.nodes().to$().find('select[name="locationID[]"]');

                    $nextRow.nodes().to$().find(".select2").select2(optselect2);
                    $nextRow.nodes().to$().find(".select2").val(-1).trigger('change');
                    $nextRow.nodes().to$().find("input[name='quantity[]']").val(0);

                    $(this).setLocationOption($location);
                }
            } else if (index != length - 1) {
                $row.remove().draw();
            }

            // Check is empty and put default number
            if (value == '') {
                $row.nodes().to$().find('.sum').val(0);
            }

            $(this).displayTotal();
        });

        $('#material tbody').on('select2:select', 'select[name="pid[]"]', function(e) {
            var index = $(this).closest("tr");

            // Set Params to Get Location
            var params = {
                product: $(this).val(),
                stock: $(this).hasViewStock(),
            };

            // Get Location
            var $location = dtable.row(index).nodes().to$()
                .find('select[name="locationID[]')
                .val(-1)
                .trigger('change');

            $(this).setLocationOption($location, params);
        });

        $('#material tbody').on('keyup', 'input[name="quantity[]"]', function(e) {
            var index = $(this).closest("tr");
            $(this).validationStock(index);
        });

        $('#material tbody').on('select2:select', 'select[name="locationID[]"]', function(evt) {
            console.log('ok');
            var index = $(this).closest("tr");

            // Get Stock
            var $stock = dtable.row(index).nodes().to$()
                .find('input[name="stock[]');

            // Set Stock Value
            var quantity = Number.parseFloat((evt.params.data.quantity || 0).toFixed(3));
            $stock.val(quantity);
            console.log(evt.params.data);
            $(this).validationStock(index);
        });

        $('select[name="for"]').on("select2:select", function(evt) {
            var $location = $('select[name="locationID[]"]');

            // Set Params
            var params = {
                product: evt.params.data.id,
                stock: 0,
            }

            $(this).setLocationOption($location, params);
        });
    </script>
@endpush