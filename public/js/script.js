$(document).ready(() => {
    $(".location-detector").click(() => {
        detectLocation((status, data) => {
            if (!status) {
                $(".form-message p").text(data);
                $(".form-message").show();
                return false;
            }

            $(".form-message p").text("");
            $(".form-message").hide();
            $(".finder-form [name=latitude]").val(data.latitude);
            $(".finder-form [name=longitude]").val(data.longitude);
        });
    });
});

/**
 * Detect user location
 */
function detectLocation(callback) {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            (position) => callback(true, position.coords),
            () => callback(false, "Please enable browser geolocation"),
            {
                maximumAge: 0,
                enableHighAccuracy: true,
                timeout: 4000,
            }
        );
    } else {
        callback(false, "Location permission is not supported in your browser");
    }
}
