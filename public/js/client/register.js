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

    $('.client_type_2').on('click', function () {
        $('.ndis-form').fadeIn().css('display', 'grid')
        $('.plan-managed-btns, .plan-managed-form .Plan_manager_email_parent').fadeIn()
    })
    $('.client_type_2').siblings().not(':last-child').on('click', function () {
        $('.ndis-form').fadeOut()
        $('.plan-managed-btns, .plan-managed-form .Plan_manager_email_parent').fadeOut()
        $('#card_number').fadeIn()
    })

    $('.plan_managment_1').on('click', function () {
        $('.plan-managed-form').fadeIn().css('display', 'grid')
        $('.card_number').fadeIn()
    })
    $('.plan_managment_1').siblings().on('click', function () {
        $('.card_number').fadeOut()
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

document.getElementById("client_submit").addEventListener("click", function(event) {
    event.preventDefault();
    clientRegisteration()
});
// end ...

// step 1 of registration
function clientRegisteration () {
    let formData = new FormData(document.getElementById('client_register'))
        $('.diagnosis li').each(function () {
        formData.append('diagnosis[]', $(this).text());
    });

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
// end ...
