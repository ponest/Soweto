function deleteConfirm(Description, Url) {
    swal({
        title: "Are you sure?",
        text: Description + " Will be Deleted!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $(location).attr('href', Url);
        }
    });
}

function actionConfirm(Description, Url, ButtonText) {
    swal({
        title: "Are you sure?",
        text: Description,
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn-warning',
        confirmButtonText: ButtonText,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $(location).attr('href', Url);
        }
    });
}

// $('select').select2();

$('select').select2({
    width: '100%'
});

$('#edit_modal').on('shown.bs.modal', function () {
    $('select').select2({
        width: '100%'
    });
});

function datePickerLoad() {
    $('.datePicker').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "yyyy-mm-dd"
    });
}

function getUnit(itemId, unitRef, unitIdRef) {
    const baseUrl = window.location.origin;
    const ajaxUrl = baseUrl + '/ajax/get_unit';

    $.ajax({
        url: ajaxUrl,
        type: "GET",
        data: {item_id: itemId},
        dataType: "json",
        success: function (resp_data) {
            if (resp_data.status === "success") {
                unitRef.val(resp_data.data.unit_name);
                unitIdRef.val(resp_data.data.unit_id);
            } else {
                swal("Warning", "Item Unit Not Found", "warning");
            }
        },
        error: function (xhr) {
            const errorMessage = xhr.status + ': ' + xhr.statusText;
            console.log(errorMessage);
            // handleAjaxError(xhr);
        }
    });
}
