/**
 * Variables
 */
var ModalDeleteSuccess = Swal.mixin({
    title: 'Deleted!',
    text: 'Your file has been deleted.',
    icon: 'success'
});

/**
 * Configuration App's
 */
$(document).ready(function () {
    $('input').attr('autocomplete', 'off');
    $('input[type=number]').attr('step', 'any');

    $(this).displayTotal();
});

$('.table tbody').on('click', '#btn_view', function (e) {
    var data = dtable.row($(this).parents('tr')).data();
    window.open(window.location.href + '/' + data['id']);
});

$('.table tbody').on('click', '#btn_edit', function (e) {
    var data = dtable.row($(this).parents('tr')).data();
    window.open(window.location.href + '/' + data['id'] + '/edit');
});

$('.table tbody').on('click', '#btn_history', function (e) {
    var data = dtable.row($(this).parents('tr')).data();
    window.open(window.location.href + '/' + data['id'] + '/history');
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
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: window.location.pathname + '/' + data['id'],
                type: 'DELETE',
                success: function success(response) {
                    if (response == 405) {
                        Swal.fire({
                            title: 'Failed Authorization',
                            text: "Only Super Admin can deleted this",
                            icon: 'error',
                        });
                    } else if (response != 'Super Admin') {
                        ModalDeleteSuccess.fire();
                        $('.table').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Super Admin',
                            text: "Super Admin can't be deleted",
                            icon: 'error',
                        });
                    }
                },
                error: function error(xhr, status, _error) {
                    if (xhr.status != '405') {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                    }
                }
            });
        }
    });
});

$('input[name="search"]').keyup(function () {
    dtable.search($(this).val()).draw();
});
