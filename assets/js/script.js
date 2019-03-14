$(document).ready(function () {
    $("#hideShow").hide();
    $("#show").click(function () {
        $("#hideShow").show();
    });
});
$(document).ready(function () {
    $("#hide").click(function () {
        $("#hideShow").hide();
    });
});

$(document).ready(function () {
    $("#hideShowContact").hide();
    $("#showEmergencyContact").click(function () {
        $("#hideShowContact").show();
    });
});
$(document).ready(function () {
    $("#hideEmergencyContact").click(function () {
        $("#hideShowContact").hide();
    });
});
