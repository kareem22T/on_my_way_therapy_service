// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...

// step 1 of registration
function step1Registeration () {
    let formData = new FormData(document.getElementById('step-1'))
    
	$.ajax({
		url: '/doctor/register',
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

			// login after registration
			let loginData = new FormData();
			loginData.append('emailorphone', $('#email').val());
			loginData.append('password', $('#password').val());

			$.ajax({
				url: '/doctor/login',
				method: 'POST',
				processData: false,
				contentType: false,
				data: loginData,
			})
		},
		error: function (err) {
			document.getElementById('errors').innerHTML = ''
			$.each(err.responseJSON.errors, function(key, value) {
				let error = document.createElement('div')
				error.classList = 'alert alert-danger'
				error.innerHTML = value[0]
				document.getElementById('errors').append(error)
			});
		},
	})
}

document.getElementById("step1_submit").addEventListener("click", function(event) {
    event.preventDefault();
    step1Registeration()
});
// end ...
