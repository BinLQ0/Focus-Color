$(document).ready(function() {
    var FORMAT_DATE = 'DD/MM/YYYY';
    /**
     * Register Element's
     */
    var dateStart = $('input[name="srcDateStart"]');
    var dateEnd = $('input[name="srcDateEnd"]');
    var search = $('input[name="search"]');

    dateStart.val(moment().startOf('month').format(FORMAT_DATE));
    dateEnd.val(moment().endOf('month').format(FORMAT_DATE));

    $('.dt-search').change(function() {
        dtable.draw(false);
    });

    $('.dt-reload').change(function() {
        Swal.fire({
            imageUrl: '../../images/loading.gif',
            showConfirmButton: false,
            width: 300,
        });
        
        dtable.ajax.reload(function(){
            Swal.close();
        });
    }).trigger('change'); 

    /**
     * Method's Tables Search
     */
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var dDate = moment(data[0], FORMAT_DATE);
            var dStart = moment(dateStart.val(), FORMAT_DATE).subtract(1, 'days');
            var dEnd = moment(dateEnd.val(), FORMAT_DATE).add(1, 'days');

            var column2 = data[1];
            var input = search.val();

            var result = (dDate.isAfter(dStart) && dDate.isBefore(dEnd)) ? true : false;

            if (settings.nTable.id !== 'history' && result) {
                result = ((input == '') || (column2.includes(input))) ? true : false;
            }

            return result;
        }
    );
});