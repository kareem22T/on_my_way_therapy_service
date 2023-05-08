// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...
let lastResponse;
$('#search').on('keyup', function () {
    $.ajax({
        url: '/client/get-search-hints',
        method: 'POST',
        dataType: "json",
        data: {search: $(this).val()},
        success: function (response) {
            if(JSON.stringify(response) !== JSON.stringify(lastResponse)) {
                // update the last response
                lastResponse = response;

                // clear the results div
                $('.results').fadeOut('fast');
                setTimeout(() => {
                $('.results').empty();

                // loop through each element of the response array
                response.forEach(function(element) {
                // append the element to the results div
                    $('.results').append('<a href="/client/search:' + element +'"><i class="fa-solid fa-magnifying-glass"></i>' + element + '</a>');
                });

                    setTimeout(() => {
                        $('.results').fadeIn('fast').css('display', 'flex');
                    }, 70);
                }, 50);
            }
        }
    })
})
$('#search').on('blur', function () {
    $('.results').fadeOut('fast');
})
$('#search').on('focus', function () {
    $('.results').fadeIn('fast').css('display', 'flex');
})


function sendRequest() {
$.ajax({
url: "example.com/my-api",
dataType: "json",
success: function(response) {
// check if the response is different from the last one
}
});
}
