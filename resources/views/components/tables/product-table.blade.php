<table id="product" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Decription</th>
            <th>Quantity</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#product').DataTable({
            ordering: false,
            paging: false,
            deferRender: true,
            dom: 't',
            ajax: {
                url: 'api/products',
                type: 'GET',
                dataSrc: 'data'
            },
            columnDefs: [{
                targets: -1,
                defaultContent: "" +
                    '<button id="btn_history" href="#" class="btn btn-sm btn-primary mr-1"><i class="fas fa-history"></i></button>' +
                    '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                data: 'name',
            }, {
                data: 'description',
            }, {
                data: 'quantity',
                className: "text-right dt-body-justify",
                render: function (data, type, row) {
                    return Number.parseFloat(data.toFixed(3));
                }

            }, {
                data: 'unit',
                className: "text-left dt-body-justify",
            },{
                data: 'action',
                width: '20%',
                className: "text-center dt-body-justify",
            }, ]
        });

    </script>
@endpush
