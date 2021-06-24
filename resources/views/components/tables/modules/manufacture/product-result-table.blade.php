<table id="result" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>No. Lot</th>
            <th>Product</th>            
            <th></th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#result').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: '{{ route("api.result") }}',
                type: 'GET',
                data: function(data) {
                    data.startDate  = $('input[name="srcDateStart"]').val();
                    data.endDate    = $('input[name="srcDateEnd"]').val();
                },
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
                }, {
                    data: 'release.for',
                    className: "text-left"
                }, {
                    data: 'description',
                    className: "text-left"
                }, {
                    data: 'action',
                    width: '5%',
                    className: "text-center dt-body-justify"
                },
            ]
        });

    </script>
    <script src="{{ url::asset('js/datatable/filter.js') }}"></script>
@endpush
