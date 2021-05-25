<table id="user" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Username</th>
            <th>Last Login</th>
            <th>IP Access</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#user').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: 'api/users',
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
                data: 'username'
            }, {
                data: 'last_seen_at',
            }, {
                data: 'attempt_ip',
            }, {
                data: 'action',
                width: '5%',
            }]
        });
        const ModalDeleteSuccess = Swal.mixin({
            title: 'Deleted!',
            text: 'Your file has been deleted.',
            icon: 'success'
        });

        $('.table tbody').on('click', '#btn_view', function (e) {
            var data = dtable.row($(this).parents('tr')).data();
            window.open(window.location.href + '/' + data['id'], '_blank');
        });

        $('.table tbody').on('click', '#btn_edit', function (e) {
            var data = dtable.row($(this).parents('tr')).data();
            window.open(window.location.href + '/' + data['id'] + '/edit', '_blank');
        });

        $('.table tbody').on('click', '#btn_delete', function (e) {
            var data = dtable.row($(this).parents('tr')).data();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: window.location.pathname + '/' + data['id'],
                        type: 'DELETE',
                        showConfirmButton: false,
                        success: function () {
                            ModalDeleteSuccess.fire();
                            $('.table').DataTable().ajax.reload();
                        },
                        error: function (xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr
                                .statusText
                            alert('Error - ' + errorMessage);
                        }
                    });
                }
            });
        });

        $('input[name="search"]').keyup(function () {
            dtable.search($(this).val()).draw();
        });

    </script>
@endpush
