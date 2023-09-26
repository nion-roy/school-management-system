// $(function () {
//     $("#form-register").validate({
//         rules: {
//             password: {
//                 required: true,
//             },
//             confirm_password: {
//                 equalTo: "#password",
//             },
//         },
//         messages: {
//             username: {
//                 required: "Please provide an username",
//             },
//             email: {
//                 required: "Please provide an email",
//             },
//             password: {
//                 required: "Please provide a password",
//             },
//             confirm_password: {
//                 required: "Please provide a password",
//                 equalTo: "Please enter the same password",
//             },
//         },
//     });
//     $("#form-total").steps({
//         headerTag: "h2",
//         bodyTag: "section",
//         transitionEffect: "fade",
//         // enableAllSteps: true,
//         autoFocus: true,
//         transitionEffectSpeed: 500,
//         titleTemplate: '<div class="title">#title#</div>',
//         labels: {
//             previous: "Back",
//             next: '<i class="zmdi zmdi-arrow-right"></i>',
//             finish: '<i class="zmdi zmdi-arrow-right"></i>',
//             current: "",
//         },
//         onStepChanging: function (event, currentIndex, newIndex) {
//             var username = $("#username").val();
//             var email = $("#email").val();
//             var cardtype = $("#card-type").val();
//             var cardnumber = $("#card-number").val();
//             var cvc = $("#cvc").val();
//             var month = $("#month").val();
//             var year = $("#year").val();

//             $("#username-val").text(username);
//             $("#email-val").text(email);
//             $("#card-type-val").text(cardtype);
//             $("#card-number-val").text(cardnumber);
//             $("#cvc-val").text(cvc);
//             $("#month-val").text(month);
//             $("#year-val").text(year);

//             $("#form-register").validate().settings.ignore =
//                 ":disabled,:hidden";
//             return $("#form-register").valid();
//         },
//     });
// });



$("form")
    .find("input, textarea, select")
    .each(function () {
        let $this = $(this);
        let label = $this.prev("label");

        if ($this.val() === "") {
            label.removeClass("active");
        } else {
            label.addClass("active");
        }
    });
$("form")
    .find("input, textarea, select")
    .on("blur focus", function (e) {
        let $this = $(this);
        let label = $this.prev("label");

        if (e.type === "blur") {
            if ($this.val() === "") {
                label.removeClass("active");
            }
        } else if (e.type === "focus") {
            label.addClass("active");
        }
    });
function valid(button) {
    let fieldset = button.closest("fieldset");
    let valid = button
        .closest("fieldset")
        .find("input")
        .toArray()
        .every((input) => input.checkValidity());
    if (!valid) {
        fieldset.removeClass("valid");
    } else {
        fieldset.addClass("valid");
    }
    fieldset.addClass("was-validated");
    return valid;
}
$("form.needs-validation").each((idx, form) => {
    $(form)
        .find("button")
        .each((idx, button) => {
            $(button).click(function () {
                // if (!valid($(button))) {
                //   event.preventDefault();
                //   event.stopPropagation();
                // }
            });
        });
});
// $('.multi-step-form > .form-container fieldset:not(:first-child)').addClass('d-none');
$(".multi-step-form > .form-container fieldset:not(:first-child)").css({
    display: "none",
});
// Reset all bars to ensure that all the progress is removed
$(".multi-step-form > .progress-container > .progress > .progress-bar").each(
    function (elem) {
        $(this).css({
            width: "0%",
        });
    }
);
$(".multi-step-form > .progress-container .progress-icon").click(function (
    event
) {
    // if (!valid($(thisFs)`fieldset.active`)) {
    //   return false;
    // }
    let lastSeen = +$(this)
        .closest(".multi-step-form")
        .find(`fieldset.seen`)
        .last()
        .data("index");
    console.log($(this).closest(".multi-step-form").find(`fieldset.seen`));
    if (+$(this).data("index") <= lastSeen) {
        moveTo($(this).closest(".multi-step-form"), +$(this).data("index"));
    }
    return false;
});
$(".multi-step-form > .form-container fieldset > button.next").click(function (
    event
) {
    let thisFs = $(this).closest("fieldset");
    let index = +thisFs.data("index");
    let msContainer = thisFs.closest(".multi-step-form");
    if (!valid($(thisFs))) {
        return false;
    } else {
        msContainer.find(`fieldset[data-index=${index + 1}]`).addClass("seen");
        msContainer
            .find(
                `div.progress-container > div.progress > div.progress-bar[data-index=${index}]`
            )
            .parent()
            .addClass("seen");
    }
    moveTo(msContainer, index + 1);
    // msContainer.find(`fieldset[data-index=${index + 1}]`)
    //   .addClass('seen');
    return false;
});
let animating = 0;
function moveTo(msContainer, index) {
    if (animating > 0) {
        return;
    }
    let steps =
        msContainer.find("div.progress-container").find(`div.progress-bar`)
            .length + 1;
    if (index > steps) {
        return;
    }
    let currFs = msContainer.find(`fieldset.active`);
    let currIndex = currFs.data("index");
    if (currIndex == index) {
        return;
    }
    let next = msContainer.find(`fieldset[data-index=${index}]`);
    let formContainer = msContainer.find(".form-container");
    let stagger = 300;
    animating++;
    formContainer.animate(
        {
            opacity: 0.0,
        },
        {
            step: function (now, fx) {
                let scaleAmount = 1 - (1 - now) * ((1 - 0.9) / (1 - 0.0));
                $(this).css("transform", "scale(" + scaleAmount + ")");
            },
            duration: 350,
            easing: "easeInBack",
            complete: function () {
                currFs.removeClass("active");
                currFs.css({
                    display: "none",
                });
                next.addClass("active");
                next.css({
                    display: "block",
                });
                formContainer.animate(
                    {
                        opacity: 1,
                    },
                    {
                        step: function (now, fx) {
                            let scaleAmount =
                                1 - (1 - now) * ((0.9 - 1) / (0 - 1));
                            $(this).css(
                                "transform",
                                "scale(" + scaleAmount + ")"
                            );
                        },
                        duration: 350,
                        easing: "easeOutBack",
                        complete: function () {
                            animating--;
                        },
                    }
                );
            },
        }
    );
    if (currIndex > index) {
        for (let i = currIndex; i >= index; i--) {
            let thisProgress = msContainer
                .find("div.progress-container")
                .find(`div.progress-bar[data-index=${i}]`);
            if (i === index) {
                animating++;
                setTimeout(function () {
                    thisProgress.css({
                        width: "0%",
                    });
                    thisProgress.find(".progress-icon").removeClass("active");
                    if (i === steps - 1) {
                        thisProgress
                            .find(".progress-icon")
                            .first()
                            .addClass("active");
                    } else {
                        thisProgress.find(".progress-icon").addClass("active");
                    }
                    animating--;
                }, (currIndex - i - 1) * stagger);
            } else {
                animating++;
                setTimeout(function () {
                    thisProgress.css({
                        width: "0%",
                    });
                    thisProgress.find(".progress-icon").removeClass("active");
                    animating--;
                }, (currIndex - i - 1) * stagger);
            }
        }
    } else {
        for (let i = currIndex; i <= index; i++) {
            let thisProgress = msContainer
                .find("div.progress-container")
                .find(`div.progress-bar[data-index=${i}]`);
            if (i < index) {
                animating++;
                setTimeout(function () {
                    thisProgress.css({
                        width: "100%",
                    });
                    thisProgress.find(".progress-icon").removeClass("active");
                    animating--;
                }, (i - currIndex) * stagger);
            } else if (i === index) {
                animating++;
                setTimeout(function () {
                    thisProgress.css({
                        width: "0%",
                    });
                    thisProgress.find(".progress-icon").removeClass("active");
                    if (i === steps - 1) {
                        thisProgress
                            .find(".progress-icon")
                            .first()
                            .addClass("active");
                    } else {
                        thisProgress.find(".progress-icon").addClass("active");
                    }
                    animating--;
                }, (i - currIndex - 1) * stagger);
            }
        }
    }
    if (index === steps) {
        animating++;
        setTimeout(function () {
            let thisProgress = msContainer
                .find("div.progress-container")
                .find(`div.progress-bar[data-index=${index - 1}]`);
            thisProgress.find(".progress-icon").last().addClass("active");
            animating--;
        }, (steps - currIndex - 1) * stagger);
    }
}


// Number Validation
// $(document).ready(function () {
//     $("#number").validate({
//         rules: {
//             number: {
//                 required: true,
//                 bdPhoneNumber: true,
//             },
//         },
//         messages: {
//             number: {
//                 required: "Please enter a phone number",
//                 bdPhoneNumber: "Please enter a valid Bangladeshi phone number",
//             },
//         },
//     });

//     // Custom validation method for Bangladeshi phone number
//     $.validator.addMethod(
//         "bdPhoneNumber",
//         function (value, element) {
//             return this.optional(element) || /^[+]?[0-9]{10,14}$/.test(value);
//         },
//         "Please enter a valid Bangladeshi phone number."
//     );
// });
// Number Validation
