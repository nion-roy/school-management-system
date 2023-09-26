(function ($) {
  var form = $("#signup-form");
  form.validate({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
      selfcontact: {
        required: true,
        phoneBD: true,
      },
      guardian: {
        required: true,
        phoneBD: true,
      },
    },
    messages: {
      email: {
        email: 'Not a valid email address <i class="ms-1 fas fa-exclamation-circle"></i>',
      },
    },
    onfocusout: function (element) {
      $(element).valid();
    },
  });
  form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    labels: {
      previous: "Previous",
      next: "Next",
      finish: "Submit",
      current: "",
    },
    titleTemplate: '<div class="title"><span class="number">#index#</span>#title#</div>',
    onStepChanging: function (event, currentIndex, newIndex) {
      form.validate().settings.ignore = ":disabled,:hidden";
      // console.log(form.steps("getCurrentIndex"));
      return form.valid();
    },
    onFinishing: function (event, currentIndex) {
      form.validate().settings.ignore = ":disabled";
      console.log(getCurrentIndex);
      return form.valid();
    },
    onFinished: function (event, currentIndex) {
      alert("Sumited");
    },
    // onInit : function (event, currentIndex) {
    //     event.append('demo');
    // }
  });

  jQuery.extend(jQuery.validator.messages, {
    required: "",
    remote: "",
    url: "",
    date: "",
    dateISO: "",
    number: "",
    digits: "",
    creditcard: "",
    equalTo: "",
  });

  $.dobPicker({
    daySelector: "#expiry_date",
    monthSelector: "#expiry_month",
    yearSelector: "#expiry_year",
    dayDefault: "DD",
    yearDefault: "YYYY",
    minimumAge: 0,
    maximumAge: 120,
  });

  $("#password").pwstrength();

  $("#button").click(function () {
    $("input[type='file']").trigger("click");
  });

  $("input[type='file']").change(function () {
    $("#val").text(this.value.replace(/C:\\fakepath\\/i, ""));
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
	
})(jQuery);
