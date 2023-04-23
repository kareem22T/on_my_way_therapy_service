// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...

// on submit & click callback
$('#step-2').on('submit', function(e) {
    e.preventDefault();
    submitInformation();
})

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
// end ...

// methods ...................................
function submitInformation() {
    let formData = new FormData(document.getElementById('step-2'));

    $('.diagnosis li').each(function () {
        formData.append('diagnosis[]', $(this).text());
    });

    $.ajax({
        url: '/therapist/information',
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

