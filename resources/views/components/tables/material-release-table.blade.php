<table id="release" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>No. Lot</th>
            <th>Product</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#release').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: '{{ route("api.release") }}',
                type: 'GET',
                dataSrc: 'data'
            },
            columnDefs: [{
                targets: -1,
                defaultContent: "" +
                    '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                    data: 'date',
                    width: '10%',
                    className: "text-center"
                }, {
                    data: 'for',
                    className: "text-left"
                }, {
                    data: 'description',
                    className: "text-left",
                    defaultContent: "N/A"
                }, {
                    data: 'isClosed',
                    render: function (data, type, row) {
                        console.log(data);
                        if (data) {
                            return '<span class="badge bg-success mr-3"> Finished </span>';
                        }
                        
                        return '<span class="badge bg-warning mr-3"> on Process </span>'
                    }
                }, {
                    data: 'action',
                    width: '5%',
                    className: "text-center dt-body-justify"
                },
            ]
        });

    </script>
    <script src="{{ url::asset('js/datatable/date.filter.js') }}"></script>
@endpush
