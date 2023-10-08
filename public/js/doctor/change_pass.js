// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrf_token
    }
});
// end ...

// on submit methodes
$('#step-1-v2').on('submit', function (e) {
    e.preventDefault();
    submitVerfication();
})
// end ...

// main methods ...

function submitVerfication() {
    let formData = new FormData(document.getElementById('step-1-v2'));
    $('.loader').fadeIn().css('display', 'flex')
    $.ajax({
        url: '/therapist/show-change-password-view',
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            document.getElementById('errors').innerHTML = ''
            let error = document.createElement('div')
            error.classList = 'alert alert-success'
            error.innerHTML = data.msg
            document.getElementById('errors').append(error)
            $('#errors').fadeIn('slow')
            setTimeout(() => {
                // $('html').html(data);
                $('.loader').fadeOut()
            }, 1200);
        },
        error: function (err) {
            document.getElementById('errors').innerHTML = ''
            $.each(err.responseJSON.errors, function (key, value) {
                let error = document.createElement('div')
                error.classList = 'alert alert-danger'
                error.innerHTML = value[0]
                document.getElementById('errors').append(error)
            });
            $('#errors').fadeIn('slow')
            setTimeout(() => {
                $('#errors').fadeOut('slow')
            }, 8000);
        }
    })
}