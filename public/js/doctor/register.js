// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...

// onsubmit callback
document.getElementById("step1_submit").addEventListener("click", function(event) {
    event.preventDefault();
    step1Registeration()
});
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
// end ...

// step 1 of registration
function step1Registeration () {
    let formData = new FormData(document.getElementById('step-1'))
    
	$.ajax({
		url: '/therapist/register',
		method: 'POST',
		processData: false,
    	contentType: false,
		data: formData,
		success: function (data) {
			document.getElementById('errors').innerHTML = ''
			let error = document.createElement('div')
			error.classList = 'alert alert-success'
			error.innerHTML = data
			document.getElementById('errors').append(error)
			$('#errors').fadeIn('slow')

			// login after registration
			let loginData = new FormData();
			loginData.append('emailorphone', $('#email').val());
			loginData.append('password', '123456789');

			setTimeout(() => {
				$.ajax({
					url: '/therapist/login',
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
			}, 2000);
		},
	})
}
// end ...
