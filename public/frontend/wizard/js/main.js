$(function () {
    $("#form-register").validate({
        // rules: {
        //     name: {
        //         required: true,
        //     },
        //     nid: {
        //         required: true,
        //     },
        //     number: {
        //         required: true,
        //         phoneBD: true,
        //     },
        //     optional_number: {
        //         phoneBD: true,
        //     },
        //     email: {
        //         required: true,
        //     },
        //     ssc_result: {
        //         required: true,
        //     },
        //     hsc_result: {
        //         required: true,
        //     },
        //     certificate: {
        //         required: true,
        //     },
        // },
        messages: {
            name: {
                required: "Please enter full name.",
            },
            nid: {
                required: "Please enter nid number.",
            },
            number: {
                required: "Please enter contact number.",
            },
            email: {
                required: "Please enter email.",
            },
            ssc_result: {
                required: "Please enter ssc result.",
            },
            hsc_result: {
                required: "Please enter hsc result.",
            },
            certificate: {
                required: "Please enter certificate or marksheet image.",
            },
        },
    });
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        // enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate: '<div class="title">#title#</div>',
        labels: {
            previous: "Back",
            next: '<i class="zmdi zmdi-arrow-right"></i>',
            finish: '<i class="zmdi zmdi-arrow-right add_now"></i>',
            current: "",
        },

        onStepChanging: function (event, currentIndex, newIndex) {
            // var name = $("#name").val();

            // $("#name-val").text(name);

            $("#form-register").validate().settings.ignore =
                ":disabled,:hidden";
            return $("#form-register").valid();
        },
    });

    // Custom validation method for Bangladeshi phone number
    $.validator.addMethod(
        "phoneBD",
        function (value, element) {
            // return this.optional(element) || /^\+8801[3456789]\d{8}$/.test(value);
            return this.optional(element) || /^01[3456789]\d{8}$/.test(value);
        },
        "Please enter a valid phone number."
    );
});
