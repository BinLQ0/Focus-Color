$(document).ready(function () {
    $(this).materialLoss();
});

$('select[name="for"]').on('change', function () {
    $(this).getMaterialUsed();
});

$('input[name="productResult"]').keyup(function () {
    $(this).materialLoss();
});

$.fn.materialLoss = function () {
    var used = $('input[name="materialUse"]').val();
    var result = $('input[name="productResult"]').val();

    var loss = used - result;

    $('input[name="materialLoss"]').val(Number.parseFloat(loss.toFixed(3)));
};

$.fn.getMaterialUsed = function () {
    $.ajax({
        url: "/../api/release/get",
        type: "GET",
        data: {
            id: $(this).val()
        },
        success: function (response) {
            $('input[name="description"]').val(response.product);
            $('input[name="materialUse"]').val(Number.parseFloat(response.used.toFixed(3)));
        },
        error: function (xhr) {
            alert(xhr.statusText);
        }
    });
}
