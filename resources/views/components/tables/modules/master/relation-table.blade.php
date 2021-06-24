<table id="relation" class="table table-hover datatable" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#relation').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: 'api/relation',
                type: 'GET',
                dataSrc: '',
            },
            columnDefs: [{
                targets: -1,
                defaultContent: "" +
                    '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                data: 'name',
                class: 'align-middle',
            }, {
                data: 'address',
            }, {
                data: null,
                class: 'text-nowrap align-middle',
                render: function (data, type, row) {

                    console.log(data.is_supplier);
                    var badges = '';
                    if (data.is_supplier == "1") {
                        badges += '<small class="badge badge-warning mr-1"> Supplier </small>';
                    }
                    if (data.is_customer == "1") {
                        badges += '<small class="badge badge-primary"> Customer </small>';
                    }
                    return badges;
                },
            }, {
                data: 'action',
                class: 'text-nowrap',
                width: '5%',
            }]
        });

    </script>
@endpush
