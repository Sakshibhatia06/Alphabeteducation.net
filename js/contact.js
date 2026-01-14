$(document).ready(function () {
    $("#contactForm").validate({
        rules: {
            name: { required: true, minlength: 2 },
            country: { required: true, minlength: 3 },
            phone: { required: true, minlength: 5 },
            email: { required: true, email: true },
            message: { required: true, minlength: 10 }
        },
        messages: {
            name: { required: "Please enter your name" },
            country: { required: "Please enter country" },
            phone: { required: "Please enter phone number" },
            email: { required: "Enter a valid email" },
            message: { required: "Enter a message" }
        },

        submitHandler: function (form) {
            $.ajax({
                url: "contact_process.php",
                type: "POST",
                data: $(form).serialize(),

                beforeSend: function () {
                    $(".button-contactForm").text("Sending...");
                },

                success: function () {
                    $("#contactForm")[0].reset();
                    $(".button-contactForm").text("Send");
                    $("#success").fadeIn();

                    setTimeout(() => {
                        $("#success").fadeOut();
                    }, 3000);
                },

                error: function () {
                    $(".button-contactForm").text("Send");
                    $("#error").fadeIn();

                    setTimeout(() => {
                        $("#error").fadeOut();
                    }, 3000);
                }
            });
        }
    });
});
