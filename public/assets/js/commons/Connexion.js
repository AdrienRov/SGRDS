$(document).ready(function () {
    $("#submitBtn").click(function () {
        var formData = $("#loginForm").serialize();

        $.ajax({
            type: "POST",
            url: "/connexion",
            data: formData,
            success: function (response) {
                loadPage("accueil");
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
