// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...

// on submit & click callback
$('#step-3').on('submit', function(e) {
    e.preventDefault();
    submitInformation();
})
// end ...

// methods ...................................
function submitInformation() {
    let formData = new FormData(document.getElementById('step-3'));

    $.ajax({
        url: '/therapist/payment',
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.status == 200) {
                document.getElementById('errors').innerHTML = ''
                let error = document.createElement('div')
                error.classList = 'alert alert-success'
                error.innerHTML = data.msg
                document.getElementById('errors').append(error)
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    location.reload()
                }, 1200);
            }
        },
        error: function(err) {
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
        }
    })
}
