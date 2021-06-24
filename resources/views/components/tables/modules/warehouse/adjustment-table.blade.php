<table id="adjustment" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>No. Adjustment</th>
            <th>Note</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#adjustment').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: '{{ route("api.adjustment") }}',
                type: 'GET',
                dataSrc: ''
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
                },
                {
                    data: 'for',
                    className: "text-left"
                },
                {
                    data: 'description',
                    className: "text-left"
                },
                {
                    data: 'status',
                    className: "text-left",
                    render: function (data, type, row) {
                        if (data == 'Upload Completed') {
                            return '<span class="badge bg-success mr-3"> ' + data + ' </span>';
                        }else if(data == 'Uploading'){
                            return '<span class="badge bg-primary mr-3">' + data + '</span>';
                        }else if(data == 'Upload Failed'){
                            return '<span class="badge bg-danger mr-3">' + data + '</span>';
                        }

                        return '<span class="badge bg-warning mr-3">' + data + '</span>';
                    },
                },
                {
                    data: 'action',
                    width: '5%',
                    className: "text-center dt-body-justify"
                },
            ]
        });

    </script>
    <script src="{{ url::asset('js/datatable/filter.js') }}"></script>
@endpush
