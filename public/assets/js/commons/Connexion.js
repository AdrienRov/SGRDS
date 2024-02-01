$(document).ready(function () {
    $("#submitBtn").click(function () {
        var formData = $("#loginForm").serialize();

        $.ajax({
            type: "POST",
            url: "/connexion",
            data: formData,
            success: function (response) {
                let data = JSON.parse(response);
                if (data.success) {
                    window.location.href = "/accueil";
                }
                else {
                    $("#error").html(data.error);

                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });


    $("#resetPassword").click(function () {
        var formData = $("#loginForm").serialize();

        $.ajax({
            type: "POST",
            url: "/forgotPassword",
            data: formData,
            success: function (response) {
                let data = JSON.parse(response);
                if (data.success) {
                    $("#error").html("Un email vous a été envoyé");
                }
                else {
                    $("#error").html("Email invalide");
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
