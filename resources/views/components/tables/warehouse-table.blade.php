<table id="warehouse" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Warehouse</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#warehouse').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: 'api/warehouses',
                type: 'GET',
                dataSrc: ''
            },
            columnDefs: [{
                targets: -1,
                width: '5%',
                className: "text-center dt-body-justify",
                defaultContent: "" +
                    '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                data: 'name'
            }, {
                data: 'address'
            }, {
                data: 'action'
            }, ]
        });

    </script>
@endpush
