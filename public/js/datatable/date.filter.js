$(document).ready(function () {
    $('#srcDateStart').val(moment().startOf('month').format('DD/MM/YYYY'));
    $('#srcDateEnd').val(moment().endOf('month').format('DD/MM/YYYY'));

    $('#srcDateStart').change(function () {
        dtable.draw();
    });

    $('#srcDateEnd').change(function () {
        dtable.draw();
    });
});

/**
 * Method's Tables Search
 */
$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var dDate = moment(data[0], 'DD/MM/YYYY');
        var column2 = data[1];
        var column3 = data[2];

        var input = $('.search-input').val();
        var dStart = moment($('#srcDateStart').val(), 'DD/MM/YYYY').subtract(1, 'days');
        var dEnd = moment($('#srcDateEnd').val(), 'DD/MM/YYYY').add(1, 'days');

        var result = (dDate.isAfter(dStart) && dDate.isBefore(dEnd)) ? true : false;

        if (settings.nTable.id !== 'history' && result) {
            result = ((input == '') || (column2.includes(input))) ? true : false;
        }

        return result;
    }
);
