// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...

let thereTherapist; // check if there is therapist logined in
$.ajax({
    url: '/therapist/there-therapist',
    method: "GET",
    success: function(data) {
        thereTherapist = data;

        if (thereTherapist) {
            let now = new Date();
            var created_at = new Date(sessionStorage.getItem('code_expiration'));
            var is_code_expired = (now.getTime() - created_at.getTime()) >= 180000 ? true : false;

            // if (sessionStorage.getItem('code_expiration') && is_code_expired) {
            //     sessionStorage.removeItem('phoneCode');
            //     sessionStorage.removeItem('emailCode');
            //     sessionStorage.removeItem('code_expiration');
            // }

            if (
                !sessionStorage.getItem('phoneCode') &&
                !sessionStorage.getItem('emailCode') && 
                !sessionStorage.getItem('code_expiration')
            ) {
                sendCodes()
            } else {
                $('.lds-ring').fadeOut('slow')
            }
        }
    },
})
// end ...

// on submit methodes
$('#step-1-v2').on('submit', function(e) {
    e.preventDefault();
    submitVerfication();
})
// end ...

// main methods ...
function sendCodes() {
    $.ajax({
        url: '/therapist/send-code',
        method: "POST",
        success: function(data) {
            if (data.status == 200) {
                document.getElementById('send_msg').innerHTML = '\
                We just have sent you verification code to your provided number\
                and another one to your email if it still not sent please wait it may take some moments\
                <br>\
                Please provide verification codes before they expire';
                sessionStorage.setItem('phoneCode', data.phone_code);
                sessionStorage.setItem('emailCode', data.email_code);
                sessionStorage.setItem('code_expiration', new Date());
                $('.lds-ring').fadeOut('slow');
            } else {
                document.getElementById('send_msg').innerHTML = '\
                there is a problem at sending codes\
                <br>\
                Please contact customer support or try again later';
                $('.lds-ring').fadeOut('slow');
            }
        },
    })
}

function submitVerfication() {
    let formData = new FormData(document.getElementById('step-1-v2'));
    formData.append('correct_phone_code', sessionStorage.getItem('phoneCode'));
    formData.append('correct_email_code', sessionStorage.getItem('emailCode'));
    let now = new Date();
    let created_at = new Date(sessionStorage.getItem('code_expiration'));
    let remainingTime = (now.getTime() - created_at.getTime())
    formData.append('remainingTime', remainingTime)

    $.ajax({
        url: '/therapist/verify',
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