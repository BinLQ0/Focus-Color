@props(['params'])

    <table id="history" class="table table-hover text-nowrap datatable" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Document Referance</th>
                <th>Description</th>
                <th>Location</th>
                <th>In</th>
                <th>Out</th>
                <th>Quantity</th>
            </tr>
        </thead>
    </table>

    @push('js')
        <script>
            var quantity = 0;

            var dtable = $('#history').DataTable({
                ordering: false,
                paging: false,
                dom: 't',
                ajax: {
                    url: '{{ route("api.history", ["product" => $params->id]) }}',
                    type: 'GET',
                    dataSrc: 'data'
                },
                columnDefs: [{
                    targets: -1,
                    defaultContent: "" +
                        '<button id="btn_view" class="btn btn-primary btn-sm mr-1"><i class="fas fa-eye"></i></button>' +
                        '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                        '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
                }],
                columns: [{
                    data: 'date',
                    width: '10%',
                    className: "text-center"
                }, {
                    data: 'document_reference',
                }, {
                    data: 'description',
                }, {
                    data: 'location',
                    width: '7%',
                },{
                    data: 'in',
                    render: function (data, type, row) {
                        quantity += data;
                        return Number.parseFloat(data.toFixed(3));
                    },
                    width: '7%',
                    className: "text-center"
                }, {
                    data: 'out',
                    render: function (data, type, row) {
                        quantity -= data;
                        return Number.parseFloat(data.toFixed(3));
                    },
                    width: '7%',
                    className: "text-center"
                }, {
                    data: null,
                    render: function (data, type, row) {
                        return Number.parseFloat(quantity.toFixed(3));
                    },
                    width: '7%',
                    className: "text-center"
                }],
            });

        </script>
        <script src="{{ url::asset('js/datatable/date.filter.js') }}"></script>
    @endpush
