jQuery(document).ready(function ($) {
    $("#unauthorised_access_page_input").closest("tr").hide();
    $('#unauthorised_access_message_input').closest("tr").hide();
    jQuery('select').change(function () {
        let _this = jQuery(this);
        if (_this.val() === 'unauthorised_access_page') {
            $("#unauthorised_access_page_input").closest("tr").show();
            $("#unauthorised_access_message_input").closest("tr").hide();
        } else {
            $("#unauthorised_access_message_input").closest("tr").show();
            $("#unauthorised_access_page_input").closest("tr").hide();
        }
    });
});



