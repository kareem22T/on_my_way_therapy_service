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

$('#profession').on('change', function () {
    if ($(this).val() == 2)
    {
        $('.changable-cer input').attr('placeholder', 'SPA registration')
        $('.changable-cer input').attr('type', 'text')
        $('.changable-cer input').attr('name', 'SPA')
        $('.changable-cer input').attr('id', 'SPA')
    } else if ($(this).val() == 5) {
        $('.changable-cer input').attr('placeholder', 'Practitioner Number')
        $('.changable-cer input').attr('type', 'text')
        $('.changable-cer input').attr('name', 'practitioner_number')
        $('.changable-cer input').attr('id', 'practitioner_number')
    }else {
        $('.changable-cer input').attr('placeholder', 'AHPRA registration')
        $('.changable-cer input').attr('type', 'text')
        $('.changable-cer input').attr('name', 'AHPRA')
        $('.changable-cer input').attr('id', 'AHPRA')
    }
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

// $(".certificte-input").prev().change(function() {
//     // check if file is valid image
//     var file = this.files[0];
//     var fileType = file.type;
//     var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png", "application/pdf"];
// 	if ($.inArray(fileType, validImageTypes) < 0) {
// 		document.getElementById('errors').innerHTML = ''
// 			let error = document.createElement('div')
// 			error.classList = 'alert alert-danger'
// 			error.innerHTML = "Invalid file type. Please choose a pdf, GIF, JPEG, or PNG image."
// 			document.getElementById('errors').append(error)
// 		$('#errors').fadeIn('slow')
// 		setTimeout(() => {
// 			$('#errors').fadeOut('slow')
// 		}, 2000);
		
//         $(this).next().find('i').removeClass('fa-edit').addClass('fa-camera');
// 	} else {
//         $(this).next().find('i').removeClass('fa-camera').addClass('fa-edit');
// 	}
// });
