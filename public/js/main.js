// Populate form with saved data on page load
window.onload = function()  {
    // Function to populate form fields with saved data
    function populateFormFields() {
        $('.form-holder input[name="firstName"]').val(localStorage.getItem('firstName'));
        $('.form-holder input[name="lastName"]').val(localStorage.getItem('lastName'));
        $('.form-holder input[name="birthday"]').val(localStorage.getItem('birthday'));
        $('.form-holder input[name="report"]').val(localStorage.getItem('report'));
        $('.select-control').val(localStorage.getItem('country'));
        $('.form-holder input[name="phone"]').val(localStorage.getItem('phone'));
        $('.form-holder input[name="email"]').val(localStorage.getItem('email'));
    }
  
    if (localStorage.getItem('country')) {
        populateFormFields();
    }
  
};


$(function(){
	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        stateSave: true,
        transitionEffectSpeed: 300,
        labels: {
            next: "Next",
            previous: "Back"
        },
        
        onStepChanging: function (event, currentIndex, newIndex) {
            localStorage.setItem('currentPageIndex', newIndex);
    
            if (currentIndex === 0) {
                // Validation for the first step
                var isValid = true;

                var firstName = $('.form-holder input[name="firstName"]').val();
                var lastName = $('.form-holder input[name="lastName"]').val();
                var birthday = $('.form-holder input[name="birthday"]').val();
                var report = $('.form-holder input[name="report"]').val();
                var country = $('.select-control').val();
                var phone = $('.form-holder input[name="phone"]').val();
                var email = $('.form-holder input[name="email"]').val();
                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
 
                if (firstName === "") {
                    $("#fname-error").show();
                    isValid = false;
                } else {
                    $("#fname-error").hide();
                }
              
                if (lastName === "") {
                    $("#lname-error").show();
                    isValid = false;
                } else {
                    $("#lname-error").hide();
                }
              
                if (birthday === "") {
                    $("#birthday-error").show();
                    isValid = false;
                } else {
                    $("#birthday-error").hide();
                }
              
                if (report === "") {
                    $("#report-error").show();
                    isValid = false;
                } else {
                    $("#report-error").hide();
                }
              
                if (country === "Country") {
                    $("#country-error").show();
                    isValid = false;
                } else {
                    $("#country-error").hide();
                }
              
                if (phone === "") {
                    $("#phone-error").show();
                    isValid = false;
                }
                else if (!/^.?1.?\(?[0-9]{3}\)?.?[0-9]{3}.?[0-9]{4}$/.test(phone)) {  
                    document.getElementById("phone-error").style.display = "block"; 
                    isValid = false;
                    document.getElementById("phone-error").innerHTML = "Invalid phone number";   
                }
                else {
                    $("#phone-error").hide();
                }
              
                if (email === "") {
                    $("#email-error").show();
                    isValid = false;
                } 
                  
                else if (reg.test(email) == false) {
                    document.getElementById("email-error").style.display = "block";
                    document.getElementById("email-error").innerHTML = "Invalid email";
                    isValid = false;
                }
                else {

                    // Perform AJAX request to check if email exists in the database
                    $.ajax({
                        url: "/mvc/validate-email",
                        type: "POST",

                        data: { email: email },
                        async : false,
                        success: function (response) {
                        if (response === 'exists') {
                            // Display error message if email already exists
                            $("#email-error").show();
                            $("#email-error").html("Email already exists in the database");
                            isValid = false;
                        } else {
                            // Perform form submission or other actions if email doesn't exist
                            $("#email-error").hide();
                            }
                        },
                        error: function(xhr,status,error){
                            console.log(status);
                            console.log(error);
                        }
                    });
                }
                return isValid;
              } 

            if ( newIndex === 1 ) {
                $('.steps').addClass('step-2');

            } else {
                $('.steps').removeClass('step-2');
            }

            if (currentIndex === 1) {
                // Save form data to local storage
                localStorage.setItem('firstName', $('.form-holder input[name="firstName"]').val());
                localStorage.setItem('lastName', $('.form-holder input[name="lastName"]').val());
                localStorage.setItem('birthday', $('.form-holder input[name="birthday"]').val());
                localStorage.setItem('report', $('.form-holder input[name="report"]').val());
                localStorage.setItem('country', $('.select-control').val());
                localStorage.setItem('phone', $('.form-holder input[name="phone"]').val());
                localStorage.setItem('email', $('.form-holder input[name="email"]').val());

                var formData = new FormData($(this)[0]);
      
                $.ajax({
                    url: '/mvc/validate-email',
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                    if (response === 'valid') {
                        // File format is valid, submit the form
                        $('#uploadForm')[0].submit();
                        }
                    },
                    error: function(xhr,status,error){
                        console.log(status);
                        console.log(error);
                    }
                });
	        };
            if ( newIndex === 2 ) {
                
                $('.steps').addClass('step-3');


            } else {
                $('.steps').removeClass('step-3');
            }


            return true; 
        },
  
        onFinished: function(event, currentIndex) {
            event.preventDefault();
 
            // Perform AJAX form submission
            var form = $(this);
            // Check if the form has already been submitted
            if (form.data('submitted')) {
                alert('Form already submitted!');
                return;
            }


            $(this).ajaxSubmit({
                url: '/mvc/input',

                data: form,
                success: function(data) {
                    alert(data);
                    // Set the form submission status to true
                    form.data('submitted', true);
                },
                error: function(xhr,status,error){
                    console.log(status);
                    console.log(error);
                }

            });


        }
    });
    
    // Custom Jquery Steps
    $('.forward').click(function(){
    	$("#wizard").steps('next');
        
    })
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    })

    // Select
    $('html').click(function() {
        $('.select .dropdown').hide(); 
    });
    $('.select').click(function(event){
        event.stopPropagation();
    });
    $('.select .select-control').click(function(){
        $(this).parent().next().toggle().toggleClass('active');
    })
    $('.select .dropdown li').click(function(){
        $(this).parent().toggle();
        var text = $(this).attr('rel');
        $(this).parent().prev().find('div').text(text);
    })
   
    // Date Picker
    var dp1 = $('#dp1').datepicker().data('datepicker');
})

