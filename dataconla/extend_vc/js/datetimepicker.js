jQuery(document).ready(function () {
    jQuery('.eventtimerdatestr').focusin(function () {
        jQuery(this).datetimepicker({
            changeMonth: true,
            changeYear: true,
            altField: '.timerdate',
            altFieldTimeOnly: false,
            altFormat: 'yy-mm-dd',
            altTimeFormat: 'HH:mm'
        });
    });
});