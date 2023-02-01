setInterval(function () {
    if (document.cookie.indexOf("access_site") < 0) {
        window.location.href = window.cookie_object.redirect_page;
        console.log("cookie Not exists")
    }
}, window.cookie_object.interval_timeout * 1000);