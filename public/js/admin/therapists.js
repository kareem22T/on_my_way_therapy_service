// set csrf token for all requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// end ...
$('.cancel').on('click', function (e) {
    e.preventDefault();
    $('.hide-content').fadeOut()
    $('.pop-up').fadeOut();
})
$('.approve-btn').on('click', function (e) {
    e.preventDefault();
    $('.hide-content').fadeIn()
    $('.approve-pop-up').fadeIn().find('input[name="therapist_id"]').val($(this).attr('id'));
})

$('.approve').on('click', function (e) {
	$.ajax({
		url: '/admin/therapists-approve',
		method: 'POST',
		data: {therapist_id: $(this).parents('.pop-up').find('input[name="therapist_id"]').val()},
		success: function (data) {
            if (data.status == 200) {
                document.getElementById('errors').innerHTML = ''
                let error = document.createElement('div')
                error.classList = 'alert alert-success'
                error.innerHTML = data.msg
                document.getElementById('errors').append(error)
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    location.reload()
                }, 2500);
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
            $('.loader').fadeOut()
			$('#errors').fadeIn('slow')
			setTimeout(() => {
				$('#errors').fadeOut('slow')
			}, 3500);
		},
	})
})