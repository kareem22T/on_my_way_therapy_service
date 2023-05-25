// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...

// callback and submint actions
$(function () {
    $('input[type="radio"]:checked').each(function() {
        $(this).nextAll('label').addClass('active');
    });

    $('.radio input').on('click', function () {
        $(this).next('label').addClass('active');
        $(this).parent().siblings().find('label').removeClass('active');
    })

    $('.services_inputs label').on('click', function () {
        $(this).toggleClass('active');
    })
    $('.services_inputs input:checked').each(function () {
        $(this).next('label').addClass('active');
        $(this).parent().siblings().find('label').removeClass('active');
    })

    $('label[for="plan_managment_1"]').on('click', function () {
        $('.plan-managed-form, .self-managed-form').fadeOut()
        $('.agency-managed-form').fadeIn()
    })
    $('label[for="plan_managment_2"]').on('click', function () {
        $('.plan-managed-form').fadeIn()
        $('.self-managed-form').fadeOut()
        $('.agency-managed-form').fadeOut()
    })
    $('label[for="plan_managment_3"]').on('click', function () {
        $('.plan-managed-form').fadeOut('fast')
        $('.self-managed-form').fadeIn().css('display', 'grid')
        $('.agency-managed-form').fadeOut()
    })

    $('label[for="client_type_1"]').on('click', function () {
        $('.ndis-form, .plan-managed-btns, .plan-managed-form').fadeOut()
        $('.private-form, .paying-form').fadeIn().css('display', 'grid')
    })
    
    $('label[for="private_paying_method_2"]').on('click', function () {
        $(".Private-health").fadeIn().css('display', 'flex')
    })
    $('label[for="private_paying_method_1"]').on('click', function () {
        $(".Private-health").fadeOut()
    })

    $('label[for="client_type_2"]').on('click', function () {
        $('.ndis-form, .plan-managed-btns, .plan-managed-form').fadeIn().css('display', 'grid')
        $('label[for="plan_managment_2"]').trigger('click').addClass('active').parent().siblings().find('label').removeClass('active')
        $('label[for="private_paying_method_1"]').trigger('click').addClass('active').parent().siblings().find('label').removeClass('active')
        $('.private-form, .paying-form, .Private-health').fadeOut()
    })

})

$("#photo").change(function() {
		// check if file is valid image
		var file = this.files[0];
		var fileType = file.type;
		var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
	if ($.inArray(fileType, validImageTypes) < 0) {
		document.getElementById('errors').innerHTML = ''
			let error = document.createElement('div')
			error.classList = 'alert alert-danger'
			error.innerHTML = "Invalid file type. Please choose a GIF, JPEG, or PNG image."
			document.getElementById('errors').append(error)
		$('#errors').fadeIn('slow')
		setTimeout(() => {
			$('#errors').fadeOut('slow')
		}, 2000);
		
		$(this).val(null);
		$("#preview").attr("src", "/imgs/doctor/uploads/therapist_profile/default.png");
		$('.photo_group label >i').fadeIn('fast');
		$('.photo_group .after i').removeClass('fa-edit').addClass('fa-plus');
	} else {
		// display image preview
		var reader = new FileReader();
		reader.onload = function(e) {
			$("#preview").attr("src", e.target.result);
			$('.photo_group .after i').removeClass('fa-plus').addClass('fa-edit');
			$('.photo_group label >i').fadeOut('fast');
		}
		reader.readAsDataURL(file);
	}
});

$('.add_diagnosis').on('click', function(e) {
    e.preventDefault();
    addDiagnosis();
})

$(document).on('click', '.diagnosis li i',  function(e) {
    $(this).parent().fadeOut();
    setTimeout(() => {
        $(this).parent().remove()
    }, 150);
})
$(document).on('click', '#verfiy_client',  function(e) {
    e.preventDefault()
    $('.loader').fadeIn()
    clientRegisteration()
})

document.getElementById("client_submit").addEventListener("click", function(event) {
    event.preventDefault();
    $('.loader').fadeIn().css('display', 'flex');
        let formData = new FormData(document.getElementById('client_register'))
        $('.diagnosis li').each(function () {
            formData.append('diagnosis[]', $(this).text());
        });
        // const checkedBoxes = document.querySelectorAll('input[name="service[]"]:checked');
        // checkedBoxes.forEach((box) => {
        //     formData.append('services[]', box.value);
        // });
	$.ajax({
		url: '/client/check-info',
		method: 'POST',
		processData: false,
    	contentType: false,
		data: formData,
		success: function (data) {
            if (data.status == 200) {
                sendCodes(formData.get('countryCode'), formData.get('phone'), formData.get('email'))
            }
		},
		error: function (err) {
			document.getElementById('errors').innerHTML = ''
			$.each(err.responseJSON.errors, function(key, value) {
				let error = document.createElement('div')
				error.classList = 'alert alert-danger'
				error.innerHTML = value[0]
				document.getElementById('errors').append(error)
			});
			$('#errors').fadeIn('slow')
            $('.loader').fadeOut()
			setTimeout(() => {
				$('#errors').fadeOut('slow')
			}, 3500);
		},
	})
});

$('.coming-soon-1').on('click', function () {
    $('.coming-soon-pop-up-1').fadeIn()
    $('.hide-content').fadeIn()
})
$('.coming-soon-pop-up-1 #cancel').on('click', function () {
    $('.coming-soon-pop-up-1').fadeOut()
    $('.hide-content').fadeOut()
})

$('label[for="account_type_2"]').on('click', function () {
    $('.for_some_one').fadeIn()
})
$('label[for="account_type_1"]').on('click', function () {
    $('.for_some_one').fadeOut()
})

$('.coming-soon-2').on('click', function () {
    $('.coming-soon-pop-up-2').fadeIn()
    $('.hide-content').fadeIn()
})
$('.coming-soon-pop-up-2 #cancel').on('click', function () {
    $('.coming-soon-pop-up-2').fadeOut()
    $('.hide-content').fadeOut()
})

$('.verify-pop-up #cancel').on('click', function (e) {
    e.preventDefault()
    $('.verify-pop-up').fadeOut()
    $('.hide-content').fadeOut()
})
// end ...

// step 1 of registration
function clientRegisteration () {
    let formData = new FormData(document.getElementById('client_register'))
    $('.diagnosis li').each(function () {
        formData.append('diagnosis[]', $(this).text());
    });
    // const checkedBoxes = document.querySelectorAll('input[name="service[]"]:checked');
    // checkedBoxes.forEach((box) => {
    //     formData.append('services[]', box.value);
    // });

    formData.append('phone_code', $('#phone_code').val());
    formData.append('email_code', $('#email_code').val());

    formData.append('correct_phone_code', sessionStorage.getItem('phoneCode'));
    formData.append('correct_email_code', sessionStorage.getItem('emailCode'));
    let now = new Date();
    let created_at = new Date(sessionStorage.getItem('code_expiration'));
    let remainingTime = (now.getTime() - created_at.getTime())
    formData.append('remainingTime', remainingTime)

	$.ajax({
		url: '/client/register',
		method: 'POST',
		processData: false,
    	contentType: false,
		data: formData,
		success: function (data) {
            if (data.status == 200) {
                document.getElementById('errors').innerHTML = ''
                let error = document.createElement('div')
                error.classList = 'alert alert-success'
                error.innerHTML = data.msg
                document.getElementById('errors').append(error)
                $('#errors').fadeIn('slow')

                // login after registration
                let loginData = new FormData();
                loginData.append('emailorphone', $('#email').val());
                loginData.append('password', $('#password').val());

                setTimeout(() => {
                    $.ajax({
                        url: '/client/login',
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        data: loginData,
                        success: function (data) {
                            location.reload();
                        },
                        error: function () {
                            location.reload();
                        }
                    })
                }, 2300);
            }

		},
		error: function (err) {
			document.getElementById('errors').innerHTML = ''
            $('.loader').fadeOut()
			$.each(err.responseJSON.errors, function(key, value) {
				let error = document.createElement('div')
				error.classList = 'alert alert-danger'
				error.innerHTML = value[0]
				document.getElementById('errors').append(error)
			});
			$('#errors').fadeIn('slow')
			setTimeout(() => {
				$('#errors').fadeOut('slow')
			}, 3500);
		},
	})
}

function addDiagnosis() {
    if ($('#diagnosis').val() == '') {
        document.getElementById('errors').innerHTML = ''
        let error = document.createElement('div')
        error.classList = 'alert alert-danger'
        error.innerHTML = 'pleas fill the diagnosis input before adding'
        document.getElementById('errors').append(error)
        $('#errors').fadeIn('slow')
        setTimeout(() => {
            $('#errors').fadeOut('slow')
        }, 2000);
    } else {
        $('.diagnosis').append('<li>' + $('#diagnosis').val() + '<i class="fa-regular fa-circle-xmark"></i>' + '</li>')
        $('#diagnosis').val('')
    }
}

function sendCodes(phone_key, phone, email) {
    $.ajax({
        url: '/client/send-code',
        method: "POST",
        data: {phone_key: phone_key, phone: phone, email: email},
        success: function(data) {
            if (data.status == 200) {
                console.log('asdfsfsdf')
                sessionStorage.setItem('phoneCode', data.phone_code);
                sessionStorage.setItem('emailCode', data.email_code);
                sessionStorage.setItem('code_expiration', new Date());
                $('.loader').fadeOut('slow');
                $('.verify-pop-up').fadeIn().css('display', 'flex')
                $('.hide-content').fadeIn()
            } else {
                document.getElementById('errors').innerHTML = ''
                let error = document.createElement('div')
                error.classList = 'alert alert-danger'
                error.innerHTML = 'failed to send codes'
                document.getElementById('errors').append(error)
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                    $('.loader').fadeOut('slow');
                }, 3500);
            }
        },
    })
}
// end ...
