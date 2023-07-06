// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': csrf_token
  }
});
// end ...
let weekWoorkingHours = [];
$('#working_hours').on('submit', function (e) {
  e.preventDefault();
})
$('#set_week').on('click', function (e) {
  e.preventDefault();

  $('#working_hours .day_name').each(function () {
    let day_data = {};
    let day_name = $(this).val();
    let start_work = $(this).siblings('.start').val();
    let end_work = $(this).siblings('.end').val();

    day_data.day_name = day_name;
    day_data.start_work = start_work;
    day_data.end_work = end_work

    weekWoorkingHours.push(day_data);
  })
  $.ajax({
    method: 'POST',
    url: '/therapist/save-times',
    data: {working_hours_data: weekWoorkingHours},
    success: function (data) {
      if (data.status === 200) {
        if (data.status == 200) {
            document.getElementById('errors').innerHTML = ''
            let error = document.createElement('div')
            error.classList = 'alert alert-success'
            error.innerHTML = data.msg
            document.getElementById('errors').append(error)
            $('#errors').fadeIn('slow')
            $('.loader').fadeIn()
            setTimeout(() => {
              $('#errors').fadeOut('slow')
              location.reload()
            }, 2000);
        }

      }
    }
  })
})
$('#set_all_weeks').on('click', function (e) {
  e.preventDefault();

  $('#working_hours .day_name').each(function () {
    let day_data = {};
    let day_name = $(this).val();
    let start_work = $(this).siblings('.start').val();
    let end_work = $(this).siblings('.end').val();

    day_data.day_name = day_name;
    day_data.start_work = start_work;
    day_data.end_work = end_work

    weekWoorkingHours.push(day_data);
  })
  $.ajax({
    method: 'POST',
    url: '/therapist/save-times',
    data: {working_hours_data: weekWoorkingHours, recurring: true},
    success: function (data) {
      if (data.status === 200) {
        if (data.status == 200) {
            document.getElementById('errors').innerHTML = ''
            let error = document.createElement('div')
            error.classList = 'alert alert-success'
            error.innerHTML = data.msg
            document.getElementById('errors').append(error)
            $('#errors').fadeIn('slow')
            $('.loader').fadeIn()
            setTimeout(() => {
              $('#errors').fadeOut('slow')
              location.reload()
            }, 2000);
        }

      }
    }
  })
})

$('.appointments tr').on('click', function (e) {
  woindow.open('/therapist/appointment/'.$(this).attr('id'), '_blank')
})