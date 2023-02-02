jQuery(document).ready(function ($) {
    let selected = $('select');
    if (selected.val() === 'unauthorised_access_page') {
        $("#unauthorised_access_page_input").closest("tr").show();
        $("#unauthorised_access_message_input").closest("tr").hide();
    } else {
        $("#unauthorised_access_message_input").closest("tr").show();
        $("#unauthorised_access_page_input").closest("tr").hide();
    }

    $('select').change(function () {
        let _this = $(this);
        if (_this.val() === 'unauthorised_access_page') {
            $("#unauthorised_access_page_input").closest("tr").show();
            $("#unauthorised_access_message_input").closest("tr").hide();
        } else {
            $("#unauthorised_access_message_input").closest("tr").show();
            $("#unauthorised_access_page_input").closest("tr").hide();
        }
    });
});



