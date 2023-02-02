setInterval(function () {
    if (document.cookie.indexOf(window.cookie_object.cookie_name) < 0) {
        window.location.href = window.cookie_object.redirect_page;
    }
}, window.cookie_object.interval_timeout * 1000);